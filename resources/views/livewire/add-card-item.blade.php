<div x-data>
    <p class="text-treGray-900 mb-4">
        <span class="font-bold text-lg">Stock disponible:</span> 
        {{$quantity}}
    </p>
    <div class="flex items-center">
        <div>
            <x-jet-secondary-button disabled x-bind:disabled="$wire.qty <=1" wire:loading.attr="disabled" wire:target="decrement" wire:click="decrement" class="text-2xl">
                -
            </x-jet-secondary-button>
            {{-- <x-jet-input value=" {{ $qty }}" class="mx-2 text-gray-700 text-2xl w-10 pl-3" /> --}}
            <span class="mx-2 text-gray-700 text-lg">
                {{ $qty }}
            </span>
            <x-jet-secondary-button x-bind:disabled="$wire.qty >= $wire.quantity" wire:loading.attr="disabled" wire:target="increment" wire:click="increment" class="text-2xl">
                +
            </x-jet-secondary-button>
        </div>
        <div class="mx-4">
            <x-jet-button class="hover:bg-orange-700 text-md pl-14 w-72 h-12" x-bind:disabled="$wire.qty > $wire.quantity" wire:loading.attr="disabled" wire:target="addItem" wire:click="addItem">
                <i class="fas fa-shopping-cart mr-2 text-xl"></i>
                Agregar a carrito
            </x-jet-button>
        </div>
    </div>
</div>
