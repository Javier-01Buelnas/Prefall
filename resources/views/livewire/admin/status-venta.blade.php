<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border mt-6">
    <p class="text-xl text-center mb-2 pb-2 font-bold font-serif uppercase">Resumen de Venta</p>
    <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
        <div class="flex justify-between items-center">
            <p class="text-trueGray-700"><span class="font-bold uppercase">No. Compra:</span>
                Compra-{{ $order->id }}
            </p>
            <p class="text-trueGray-700"><span class="font-bold uppercase">Cliente:</span>
                {{ $order->user->name }}
            </p>
        </div>

        <div class="px-12 lg:px-20 py-6 flex items-center">
            <div class="relative">
                <div
                    class="{{ $order->status >= 2 && $order->status != 5 ? 'bg-green-700' : 'bg-gray-400' }} rounded-full h-6 w-6 flex items-center justify-center">
                    <i
                        class="fas fa-check {{ $order->status >= 2 && $order->status != 5 ? 'text-white' : 'text-gray-200' }} text-xs"></i>
                </div>
                <div class="absolute -left-8 mt-0.5">
                    <p
                        class="{{ $order->status >= 2 && $order->status != 5 ? 'text-green-600 font-semibold' : 'text-gray-600' }} font-serif">
                        Confirmado</p>
                </div>
            </div>

            <div
                class="{{ $order->status >= 3 && $order->status != 5 ? 'bg-green-700' : 'bg-gray-400' }} h-1 flex-1 mx-2">
            </div>

            <div class="relative">
                <div
                    class="{{ $order->status >= 3 && $order->status != 5 ? 'bg-green-700' : 'bg-gray-400' }} rounded-full h-6 w-6 flex items-center justify-center">
                    <i
                        class="fas fa-check {{ $order->status >= 3 && $order->status != 5 ? 'text-white' : 'text-gray-200' }} text-xs"></i>
                </div>
                <div class="absolute -left-8 mt-0.5">
                    <p
                        class="{{ $order->status >= 3 && $order->status != 5 ? 'text-green-600 font-semibold' : 'text-gray-600' }} font-serif">
                        Despachado</p>
                </div>
            </div>

            <div
                class=" {{ $order->status >= 4 && $order->status != 5 ? 'bg-green-700' : 'bg-gray-400' }} h-1 flex-1 mx-2">
            </div>

            <div class="relative">
                <div
                    class="{{ $order->status >= 4 && $order->status != 5 ? 'bg-green-700' : 'bg-gray-400' }} rounded-full h-6 w-6 flex items-center justify-center">
                    <i
                        class="fas fa-check {{ $order->status >= 4 && $order->status != 5 ? 'text-white' : 'text-gray-200' }} text-xs"></i>
                </div>
                <div class="absolute -left-6 mt-0.5">
                    <p
                        class="{{ $order->status >= 4 && $order->status != 5 ? 'text-green-600 font-semibold' : 'text-gray-600' }} font-serif">
                        Entregado</p>
                </div>
            </div>
        </div>

        <div class="mt-4 border-2 p-2">
            <form wire:submit.prevent="update">
                <p>Estado de la compra</p>
                <div class="flex space-x-3 items-center">
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="satus" value="2" class="mr-2">
                        Confirmado
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="satus" value="3" class="mr-2">
                        Despachado
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="satus" value="4" class="mr-2">
                            Entregado
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="satus" valenvio" class="mr-2">
                        Anulado
                    </x-jet-label>
                    <x-jet-button class="ml-auto">
                        Actualizar
                    </x-jet-button>
                </div>
            </form>
        </div>
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