<div>
    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        // Costo de envio
        $shipments = new MercadoPago\shipments();
        $shipments->cost = $order->costo_envio;
        $shipments->mode = 'not_specified';
        
        $preference->shipments = $shipments;
        
        // Crea un ítem en la preferencia
        foreach ($items as $producto) {
            $item = new MercadoPago\Item();
            $item->title = $producto->name;
            $item->quantity = $producto->qty;
            $item->unit_price = $producto->price;
        
            $productos[] = $item;
        }
        
        $preference->back_urls = [
            'success' => route('orders.pay', $order),
            'failure' => 'http://www.tu-sitio/failure',
            'pending' => 'http://www.tu-sitio/pending',
        ];
        $preference->auto_return = 'approved';
        
        $preference->items = $productos;
        $preference->save();
    @endphp
    <div class=" container mt-6 mb-12 py-6 border-2 ">
        <p class="text-xl text-center mb-2 py-2 font-bold font-serif uppercase">Resumen del pedido</p>
        <div class="grid md:grid-cols-6 gap-6">

            <div class="md:col-span-4">
                <div class="flex justify-between bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                    <p class="text-trueGray-700"><span class="font-bold uppercase">No. Orden:</span>
                        Orden-{{ $order->id }}
                    </p>
                    <p class="text-trueGray-700"><span class="font-bold uppercase">Cliente:</span>
                        {{ $order->user->name }}
                    </p>
                </div>

                <div class="p-6 border mb-6">
                    <div class="grid grid-cols-2 gap-6 px-6">
                        <div class="text-trueGray-700">
                            <p class="text-lg text-black font-bold">Entrega de pedido</p>
                            @if ($order->envio_type == 1)
                                <p class="text-sm">Los productos se entregaran en la tienda</p>
                                <p class="text-sm">
                                    <i class="fas fa-store text-orange-600 mr-2"></i>Blvd. Luis Donaldo Colosio 1281,
                                    Col.
                                    Lomas
                                    de
                                    San Agustín, Naucalpan, Estado de México.
                                </p>
                            @else
                                <p class="text-sm">Los productos se enviaran a:</p>
                                <p>México - {{ $envio->estado }} - {{ $envio->municipio }} -
                                    {{ $envio->localidad }}</p>
                                <p class="text-sm">
                                    <i class="fas fa-home text-orange-600 mr-2"></i>{{ $envio->direccion }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <p class="text-lg text-black font-bold">Datos de Contacto</p>

                            <p class="text-sm">
                                <i class="fas fa-user"></i> Se entregara a: {{ $order->contacto }}
                            </p>
                            <p class="text-sm"><i class="fas fa-phone-alt"></i> Telefono de contacto:
                                {{ $order->telefono }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg px-6   py-4 mb-6 text-gray-700">
                    <p class="text-xl font-bold mb-4">Lista de productos</p>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-b">
                                    <td>
                                        <div class="flex items-center">
                                            <img class="h-12 w-12 object-cover mr-4" src="{{ $item->options->image }}"
                                                alt="">
                                            <article>
                                                <h1 class="font-bold">{{ $item->name }}</h1>
                                            </article>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        ${{ $item->price }} MXN
                                    </td>
                                    <td class="text-center">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="text-center">
                                        ${{ $item->price * $item->qty }} MXN
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:col-span-2 bg-white p-3 border">
                <div class="p-6 mt-4 mb-6 ">
                    {{-- <div class="flex justify-between items-center"> --}}
                    <div></div>
                    <div class="text-gray-700">
                        <p class="flex justify-between items-center text-md font-semibold">Subtotal:
                            <span>${{ $order->total - $order->costo_envio }} MXN</span>
                        </p>
                        <p class="flex justify-between items-center text-md font-semibold">Envio:
                            <span>
                                @if ($order->costo_envio == 0)
                                    Gratis
                                @else
                                    ${{ $order->costo_envio }} MXN
                                @endif
                            </span>
                        </p>
                        <p class="flex justify-between items-center text-lg uppercase font-semibold">Total:
                            <span> ${{ $order->total }} MXN</span>
                        </p>
                    </div>
                    {{-- </div> --}}
                    <div class="my-8">
                        <div class="w-full bg-sky-500 rounded-sm py-1">
                            <div class="cho-container flex justify-center"></div>
                        </div>
                        <div class="mt-2" id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        {{-- SDK MercadoPago.js V2 --}}
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        {{-- PayPal --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=MXN">
        </script>

        <script>
            // Agrega credenciales de SDK
            const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
                locale: 'es-MX'
            });

            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '{{ $preference->id }}'
                },
                render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Mercado Pago', // Cambia el texto del botón de pago (opcional)
                }
            });
       
            paypal.Buttons({

                // Sets up the transaction when a payment button is clicked
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "{{ $order->total }}" // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                            }
                        }]
                    });
                },

                // Finalize the transaction after payer approval
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        Livewire.emit('payOrder');

                        // Successful capture! For dev/demo purposes:
                        /* console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                var transaction = orderData.purchase_units[0].payments.captures[0];
                                alert('Transaction ' + transaction.status + ': ' + transaction.id +
                                    '\n\nSee console for all available details');
         */
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // var element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '';
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                    });
                }
            }).render('#paypal-button-container');
        </script>
    @endpush
</div>
