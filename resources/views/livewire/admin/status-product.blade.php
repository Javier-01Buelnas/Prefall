<div class="p-4 my-4 border">
    <x-jet-label value="Estado del producto" class="text-center text-lg font-semibold" />
    <div class="flex justify-between items-center">
        <div class="flex">
            <label class="mr-4 text-sm">
                <input wire:model.defer="status" type="radio" name="status" value="1">
                Producto en borrador
            </label>
            <label class="text-sm">
                <input wire:model.defer="status" type="radio" name="status" value="2">
                Producto publicado
            </label>
        </div>
        <div class="flex items-center"> 
            <x-jet-action-message class="mr-3 bg-green-700 text-white rounded-lg p-2" on="saved">
                Estado del producto actualizado
            </x-jet-action-message>
            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire.target="save">
                Actualizar
            </x-jet-button>
        </div>
    </div>
</div>
