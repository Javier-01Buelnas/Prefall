@props(['producto'])
<li class="bg-white rounded-lg shadow border border-trueGray-200">
    <article>
        <a href="{{ route('productos.show', $producto) }}">
            <figure>
                @if ($producto->images->count())
                    <img class="h-48 w-full object-cover object-center"
                        src="{{ Storage::url($producto->images->first()->url) }}" alt="">
                @else
                    <img class="h-48 w-full object-cover object-center"
                        src="https://images.pexels.com/photos/4709404/pexels-photo-4709404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                @endif
            </figure>
            <div class="py-4 px-4">
                <h1 class="text-lg font-semibold font-serif">
                    {{ Str::limit($producto->nombre, 20) }}
                </h1>
                <p class="font-bold text-orange-700">$ {{ $producto->precioVenta }}</p>
                <p class="font-semibold font-serif flex justify-center">
                    {{ $producto->marca->nombre }}</p>
            </div>
            <div class="flex justify-center mb-2">
                <x-jet-button class="bg-orange-600 rounded-2xl">
                    Más información
                </x-jet-button>
            </div>
        </a>
    </article>
</li>
