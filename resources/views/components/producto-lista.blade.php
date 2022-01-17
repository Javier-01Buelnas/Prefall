@props(['producto'])
<li class="bg-white rounded-lg shadow mb-4">
    <a href="{{ route('productos.show', $producto) }}">
        <article class="flex">
            <figure>
                @if ($producto->images->count())
                    <img class="h-48 w-56 object-cover object-center"
                        src="{{ Storage::url($producto->images->first()->url) }}" alt="">
                @else
                    <img class="h-48 w-56 object-cover object-center"
                        src="https://images.pexels.com/photos/4709404/pexels-photo-4709404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                        alt="">

                @endif
            </figure>
            <div class="flex-1 py-4 px-6 flex flex-col">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-lg font-semibold font-serif">
                            {{ $producto->nombre }}
                        </h1>
                        <p class="font-bold text-red-700 mt-3.5">$
                            {{ $producto->precioVenta }}</p>

                        <p>{{ $producto->marca->nombre }}</p>

                    </div>
                    <div class="flex items-center">
                        <ul class="flex text-sm">
                            <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                            <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                            <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                            <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                            <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                        </ul>
                        <span class="text-gray-700 text-sm">( )</span>
                    </div>
                </div>
                <div class="mb-4 ml-auto">
                    <x-jet-button class="bg-orange-600 rounded-2xl">
                        Más información
                    </x-jet-button>
                </div>
            </div>
        </article>
    </a>
</li>
