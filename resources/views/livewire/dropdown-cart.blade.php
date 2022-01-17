<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cart color="white" size=30 />
                @if (Cart::count())
                    <span
                        class="absolute top-0 right-0 inline-block items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{ Cart::count() }}
                    </span>
                @else
                    <span
                        class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    </span>
                @endif


            </span>
        </x-slot>
        <x-slot name="content">
            <ul class="my-2">
                @forelse (Cart::content() as $item)
                    <div class="flex justify-between p-2 border-b">
                        <li class="flex">
                            <img class="h-12 w-12 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                            <article class="flex-1">
                                <h1 class="font-bold text-sm font-serif">{{ $item->name }}</h1>
                                <div class="flex mt-1">
                                    <p class="text-sm"><span class="font-bold">Cant:</span> {{ $item->qty }}</p>
                                    <p class="text-sm ml-8"><span class="font-bold">Precio:</span>  $ {{ $item->price }}</p>
                                </div>
                            </article>
                        </li>
                        <a class="ml-6 cursor-pointer text-red-600 hover:text-trueGray-700"
                            wire:click="delete('{{ $item->rowId }}')" wire:loading.class="text-red-600 opacity-25"
                            wire:target="delete('{{ $item->rowId }}')">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </a>
                    </div>
                @empty
                    <li class="py-4 px-2">
                        <p class="text-center font-serif text-gray-700">
                            Tu carrito esta vacio.
                        </p>
                    </li>
                @endforelse
            </ul>
            @if (Cart::count())
                <div class="flex justify-between items-center py-2 px-4">
                    <div>
                        <p class="text-md"><span class="font-bold font-serif text-lg">Total:</span> $
                            {{ Cart::subtotal() }}</p>
                    </div>
                    <x-button-enlace href="{{ route('cart') }}">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Ir a carrito
                    </x-button-enlace>
                </div>
            @endif
        </x-slot>
    </x-jet-dropdown>
</div>
