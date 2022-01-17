<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-900">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Crear Producto
            </h2>
        </div>

    </x-slot>
    <h1 class="text-3xl text-center font-bold mb-6">Complete la informacion solicitada para crear un producto</h1>
    <div class="bg-white shadow-xl rounded-lg p-6">
    <div class="flex gap-6 ">
        <div>
            <x-jet-label value="Clave:" />
            <x-jet-input type="text" wire:model="clave" class="w-24" placeholder="Clave" />
            <x-jet-input-error for="clave" />
        </div>
        <div>
            <x-jet-label value="Nombre:" />
            <x-jet-input class="w-96" wire:model="nombre" type="text" placeholder="Nombre del producto" />
            <x-jet-input-error for="nombre" />
        </div>
        <div>
            <x-jet-label value="Cantidad:" />
            <x-jet-input wire:model="stock" class="w-full" type="number" placeholder="Cantidad de productos" />
            <x-jet-input-error for="stock" />
        </div>

    </div>
    <div class="mt-4">
        <x-jet-label value="Slug:" hidden />
        <x-jet-input class="w-full" wire:model="slug" type="text" disabled hidden
            placeholder="Slug del producto" />

    </div>
    <div class="mt-4">
        <div wire:ignore>
            <x-jet-label value="Descripcion:" />
            <textarea class="w-full form-control" name="" id="" cols="30" rows="4" wire:model="descripcion" x-data
                x-init=" ClassicEditor
                .create( $refs.miEditor )
                .then(function(editor){
                    editor.model.document.on('change:data', () =>{
                        @this.set('descripcion', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );" x-ref="miEditor">
            </textarea>
        </div>
        <x-jet-input-error for="descripcion" />
    </div>

    <div class="grid grid-cols-2 gap-6 my-4">
        {{-- Categoria --}}
        <div>
            <x-jet-label value="Categorias" />
            <select class="w-full form-control" wire:model="categoria_id">
                <option value="" selected disabled>Eliga una Categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="categoria_id" />
        </div>
        {{-- Subcategoria --}}
        <div>
            <x-jet-label value="Subcategorias" />
            <select class="w-full form-control" wire:model="subcategoria_id">
                <option value="" selected disabled>Eliga una Subcategoria</option>
                @foreach ($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="subcategoria_id" />
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6 my-4">
        <div>
            <x-jet-label value="Marca:" />
            <select class="form-control w-full" wire:model="marca_id">
                <option value="" selected disabled>Eliga una Marca</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="marca_id" />
        </div>
        <div>
            <x-jet-label value="Precio Compra:" />
            <x-jet-input wire:model="precioCompra" class="w-full" type="number" step=".01"
                placeholder="Precio de compra" />
            <x-jet-input-error for="precioCompra" />
        </div>
        <div>
            <x-jet-label value="Precio Venta:" />
            <x-jet-input wire:model="precioVenta" class="w-full" type="number" step=".01"
                placeholder="Precio de compra" />
            <x-jet-input-error for="precioVenta" />

        </div>
    </div>

    <div class="flex justify-end items-center mt-2">
        <x-jet-danger-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
            Crear Producto
            <i class="fas fa-save ml-2"></i>
        </x-jet-danger-button>
        <x-button-enlace href="{{ route('admin.index') }}">
            Cancelar
            <i class="fas fa-times ml-2"></i>
        </x-button-enlace>
    </div>
</div>
</div>
