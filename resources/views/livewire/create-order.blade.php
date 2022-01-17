<div>
    <div class="container flex text-gray-600 text-md py-2">
        <a href="/">Inicio</a>
        <p class="mx-2">/</p>
        <a href="{{ route('cart') }}">Carrito de compras</a>
        <p class="mx-2">/</p>
        <p>Resumen de tu pedido</p>
    </div>

    <div class="container py-8 grid lg:grid-cols-5 gap-6">
        <div class="lg:col-span-3 border-2 px-2">
            <p class="mb-3 text-lg text-trueGray-700 py-4 px-6 font-bold font-serif">Informacion de contacto</p>
            <div class="bg-white rounded-lg shadow p-6 grid lg:grid-cols-2 gap-6">
                <div>

                    <x-jet-label value="Nombre de contacto" />
                    <x-jet-input wire:model.defer="contact" type="text"
                        placeholder="Nombre de quien recibira el producto" class="w-full" />
                    <x-jet-input-error for="contact" />
                </div>
                <div>
                    <x-jet-label value="Numero de contacto" />
                    <x-jet-input wire:model.defer="phone" type="text" placeholder="Numero de contacto"
                        class="w-full" />
                    <x-jet-input-error for="phone" />
                </div>
            </div>

            <div x-data="{envio_type: @entangle('envio_type')}">
                <p class="mt-6 mb-3 text-lg text-trueGray-700 py-4 px-6 font-bold font-serif">Dirección de entrega</p>
                <label class="bg-white rounded-lg shadow px-6 py-4  mb-4 flex items-center hover:text-orange-600">
                    <input x-model="envio_type" type="radio" name="envio_type" value="1" class="text-orange-600">
                    <span class="mx-4 ">
                        <i class="fas fa-store text-orange-600"></i> Recoger en tienda
                        (Blvd. Luis Donaldo Colosio 1281, Col. Lomas de San Agustín, Naucalpan,
                        Estado de México)
                    </span>
                    <span class="font-semibold text-orange-600 ml-auto">Gratis</span>

                </label>

                <div class="bg-white rounded-lg shadow ">
                    <label class="px-6 py-4 flex items-center hover:text-orange-600">
                        <input x-model="envio_type" type="radio" name="envio_type" value="2" class="text-orange-600">
                        <span class="mx-4 ">
                            <i class="fas fa-home text-orange-600"></i> Entrega a domicilio
                        </span>
                    </label>
                    <div class="hidden" :class="{ 'hidden': envio_type != 2 }">
                        <div class="px-6 pb-6 grid lg:grid-cols-2 gap-6">

                            {{-- estados --}}
                            <div>
                                <x-jet-label value="Estado" />
                                <select class="form-comtrol w-full" wire:model="estado_id">
                                    <option value="" disabled selected>Eliga una opción</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="estado_id" />
                            </div>
                            {{-- localidades --}}
                            <div>
                                <x-jet-label value="Municipio" />
                                <select class="form-comtrol w-full" wire:model="municipio_id">
                                    <option value="" disabled selected>Eliga una opción</option>
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="municipio_id" />
                            </div>
                            {{-- localidades --}}
                            <div>
                                <x-jet-label value="Localidad" />
                                <select class="form-comtrol w-full" wire:model="localidad_id">
                                    <option value="" disabled selected>Eliga una opción</option>
                                    @foreach ($localidades as $localidad)
                                        <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="localidad_id" />
                            </div>

                            <div class="col-span-2">
                                <x-jet-label value="Dirección" />
                                <x-jet-input wire:model="address" type="text" class="w-full" />
                                <x-jet-input-error for="address" />
                            </div>

                            <div class="col-span-2">
                                <x-jet-label value="Referencias" />
                                <x-jet-input wire:model="references" type="text" class="w-full" />
                                <x-jet-input-error for="references" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="ml-4 pt-6 px-4 border-2">
                <p class="text-center font-bold font-serif pb-3">RESUMEN DE TU PEDIDO</p>
                {{-- cart-items --}}
                <ul class="my-2 shadow-lg rounded-lg">
                    @forelse (Cart::content() as $item)
                        <div class="flex justify-between p-2 border-b">
                            <li class="flex">
                                <img class="h-12 w-12 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                <article class="flex-1">
                                    <h1 class="font-bold text-sm font-serif">{{ $item->name }}</h1>
                                    <div class="flex mt-1">
                                        <p class="text-sm"><span class="font-bold">Cant:</span>
                                            {{ $item->qty }}</p>
                                        <p class="text-sm ml-8"><span class="font-bold">Precio:</span> $
                                            {{ $item->price }}</p>
                                    </div>
                                </article>
                            </li>

                        </div>
                    @empty
                        <li class="py-4 px-2">
                            <p class="text-center font-serif text-gray-700">
                                Tu carrito esta vacio.
                            </p>
                        </li>
                    @endforelse
                </ul>

                <div class="my-6 px-6">
                    <p class="flex justify-between items-center">No. Productos:
                        <span class="text-orange-600 font-bold">{{ Cart::count() }} Uds.</span>
                    </p>

                    <p class="flex justify-between items-center">Costo de envio:
                        <span class="text-orange-600 font-bold">
                            @if ($envio_type == 1 || $costo_envio == 0)
                                Gratis
                            @else
                                $ {{ $costo_envio }}
                            @endif
                        </span>
                    </p>

                    <p class="flex justify-between items-center">Subtotal:
                        <span class="text-orange-600 font-bold">$ {{ Cart::subTotal() }}</span>
                    </p>

                    <hr class="mt-4 mb-6">

                    <p class="flex justify-between items-center text-orange-600 font-bold">
                        <span class="text-lg font-serif font-bold ">Total:</span>
                        @if ($envio_type == 1 || $costo_envio == 0)
                            $ {{ Cart::subTotal() }}
                        @else
                            $ {{ Cart::subTotal() + $costo_envio }}
                        @endif

                    </p>

                </div>
                <div class="flex justify-end">
                    <x-jet-button class="mb-4" wire:loading.attr="disabled" wire:target="create_order"
                        wire:click="create_order">
                        Continuar
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>
