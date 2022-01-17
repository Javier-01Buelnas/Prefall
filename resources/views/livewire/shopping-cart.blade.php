<div>
    <div class="container flex text-gray-600 text-md py-2">
        <a href="/">Inicio</a>
        <p class="mx-2">/</p>
        <a href="{{ route('cart') }}">Carrito de compras</a>
    </div>

    <div class="container py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
            <div class="md:col-span-2 lg:col-span-3">
                <section class="bg-white rounded-lg shadow-lg p-6 text-trueGray-900">

                    <div class="flex mb-6 border-b-4 justify-between">
                        <h1 class="font-bold text-lg">CARRITO DE COMPRAS</h1>
                        @if (Cart::count())
                            <a class="cursor-pointer hover:text-red-700" wire:click="destroy">
                                <i class="fas fa-trash"></i>
                                Vaciar carrito
                            </a>
                        @endif
                    </div>
                    @if (Cart::count())
                        <table class="table-auto w-full">
                            <thead class="mb-4 border-b">
                                <tr>
                                    <th></th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                    <tr class="border-b">
                                        <td>
                                            <div class="flex">
                                                <img class="h-12 w-15 object-cover mr-4"
                                                    src="{{ $item->options->image }}" alt="">
                                                <p class="font-bold">{{ $item->name }}</p>
                                                <p>{{ $item->options->brand }}</p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $ {{ $item->price }}
                                        </td>
                                        <td class="text-center">
                                            @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                        </td>
                                        <td class="text-center">
                                            <p>$ {{ $item->price * $item->qty }}</p>
                                        </td>
                                        <td>
                                            <a class="ml-6 cursor-pointer text-red-600 hover:text-trueGray-700"
                                                wire:click="delete('{{ $item->rowId }}')"
                                                wire:loading.class="text-red-600 opacity-25"
                                                wire:target="delete('{{ $item->rowId }}')">
                                                <i class="fas fa-times-circle fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="flex flex-col items-center">
                            <x-cart class="mt-4" color="orange" size="50" />
                            <p class="text-lg text-orange-600 font-serif font-bold mt-4">NO TIENES PRODUCTOS EN TU
                                CARRITO
                                DE COMPRAS</p>
                            <x-button-enlace href="/" class="my-20">
                                Comprar Ahora
                            </x-button-enlace>
                        </div>
                    @endif
                </section>
            </div>
            <div class="ml-4 pt-6 px-4 border-2 bg-white">
                <p class="text-center text-xl font-bold font-serif pb-3 border-b">RESUMEN DE TU PEDIDO</p>
                <div class="flex justify-between mt-6 pb-2 border-b">
                    <p class="text-lg">No. Productos:</p>
                    <span class="text-orange-600 font-bold">{{ Cart::count() }} Uds.</span>
                </div>
                <div class="flex justify-between mt-6 pb-2 border-b">
                    <p class="text-lg">Total:</p>
                    <span class="text-orange-600 font-bold">$ {{ Cart::subTotal() }}</span>
                </div>
                @if (Cart::count())
                    <x-button-enlace href="{{ route('orders.create') }}" class="my-8 ml-12">
                        Procesar Compra
                    </x-button-enlace>
                @endif
            </div>
        </div>
    </div>
</div>
