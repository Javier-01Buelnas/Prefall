<div class="flex-1 relative" x-data>

    <form action="{{route('search')}}" autocomplete="off">
        <x-jet-input name="nombre" wire:model="search" type="text" class="w-full rounded-3xl" placeholder="¿Que estas buscando?" />
        <button class="absolute -ml-8 mt-2.5">
            <i class="fas fa-search fa-lg text-orange-600 "></i>
        </button>
    </form>

    <div class="absolute w-full hidden" :class="{'hidden' : !$wire.open}" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow mt-1 border-2">
            <div class="px-4 py-3">
                @forelse ($productos as $producto)
                    <a href="{{ route('productos.show', $producto) }}" class="flex mb-2 border-b-2 pb-1">
                        @if ($producto->images->count())
                            <img class="w-10 h-10 object-cover rounded"
                                src="{{ Storage::url($producto->images->first()->url) }}" alt="">
                        @else
                            <img class="w-10 h-10 object-cover rounded"
                                src="https://images.pexels.com/photos/4709404/pexels-photo-4709404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                alt="">
                        @endif
                        <div class="ml-4 text-trueGray-800 pb-1">
                            <p class="font-semibold">{{ $producto->nombre }}</p>
                            <div class="flex">
                                <p class="text-sm font-serif mr-2.5 leading-3"><span
                                        class="text-black leading-3">Categoria:</span>
                                    {{ $producto->subcategoria->categoria->nombre }}</p>
                                <p class="text-sm font-serif border-l-2 pl-2 leading-3"><span
                                        class="text-black leading-3">Marca:</span>
                                    {{ $producto->marca->nombre }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-sm font-serif leading-3 text-center">
                        No hay productos que concuerden con la busqueda.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
