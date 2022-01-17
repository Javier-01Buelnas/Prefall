<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Editar Producto
                </h2>
                <x-jet-danger-button class="ml-auto" wire:click="$emit('deleteProduct')">Eliminar Producto
                    <i class="fas fa-trash ml-2"></i>
                </x-jet-danger-button>

            </div>
        </div>
    </header>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-900">
        <h1 class="text-3xl text-center font-bold mb-6">Actualizar informacion del producto</h1>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="my-4" wire:ignore>
                <form action="{{ route('admin.productos.files', $producto) }}" class="dropzone"
                    id="my-awesome-dropzone" method="POST"></form>
            </div>
            @if ($producto->images->count())
                <section class="shadow-xl border rounded-lg p-6 my-8">
                    <h1 class="text-xl text-center font-semibold font-sans mb-2">Imagenes del producto</h1>
                    <ul class="flex flex-wrap">
                        @foreach ($producto->images as $image)
                            <li class="relative" wire:key="image-{{ $image->id }}">
                                <img class="w-32 h-32 object-cover m-2 rounded-lg"
                                    src="{{ Storage::url($image->url) }}" alt="">
                                <x-jet-danger-button class="absolute right-2 top-2"
                                    wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                    wire:target="deleteImage({{ $image->id }})">
                                    x
                                </x-jet-danger-button>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
            @livewire('admin.status-product', ['producto' => $producto], key('status-producto-' . $producto->id))

            <x-jet-label value="Datos del producto" class="text-center text-lg font-semibold" />
            <div class="flex gap-6">
                <div>
                    <x-jet-label value="Clave:" />
                    <x-jet-input type="text" wire:model.defer="clave" class="w-24" placeholder="Clave" />
                    <x-jet-input-error for="clave" />
                </div>
                <div>
                    <x-jet-label value="Nombre:" />
                    <x-jet-input class="w-96" wire:model="producto.nombre" type="text"
                        placeholder="Nombre del producto" />
                    <x-jet-input-error for="producto.nombre" />
                </div>
                <div>
                    <x-jet-label value="Cantidad:" />
                    <x-jet-input wire:model.defer="producto.stock" class="w-full" type="number"
                        placeholder="Cantidad de productos" />
                    <x-jet-input-error for="producto.stock" />
                </div>

            </div>
            <div class="mt-4">
                <x-jet-label value="Slug:" hidden />
                <x-jet-input class="w-full" wire:model="slug" type="text" hidden disabled
                    placeholder="Slug del producto" />
                <x-jet-input-error for="slug" hidden />

            </div>
            <div class="mt-4">
                <div wire:ignore>
                    <x-jet-label value="Descripcion:" />
                    <textarea class="w-full form-control" name="" id="" cols="30" rows="4"
                        wire:model.defer="producto.descripcion" x-data x-init=" ClassicEditor
                .create( $refs.miEditor )
                .then(function(editor){
                    editor.model.document.on('change:data', () =>{
                        @this.set('producto.descripcion', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );" x-ref="miEditor">
            </textarea>
                </div>
                <x-jet-input-error for="producto.descripcion" />
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
                    <select class="w-full form-control" wire:model="producto.subcategoria_id">
                        <option value="" selected disabled>Eliga una Subcategoria</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="producto.subcategoria_id" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 my-4">
                <div>
                    <x-jet-label value="Marca:" />
                    <select class="form-control w-full" wire:model="producto.marca_id">
                        <option value="" selected disabled>Eliga una Marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="producto.marca_id" />
                </div>
                <div>
                    <x-jet-label value="Precio Compra:" />
                    <x-jet-input wire:model.defer="producto.precioCompra" class="w-full" type="number" step=".01"
                        placeholder="Precio de compra" />
                    <x-jet-input-error for="producto.precioCompra" />
                </div>
                <div>
                    <x-jet-label value="Precio Venta:" />
                    <x-jet-input wire:model.defer="producto.precioVenta" class="w-full" type="number" step=".01"
                        placeholder="Precio de compra" />
                    <x-jet-input-error for="producto.precioVenta" />

                </div>
            </div>

            <div class="flex justify-end items-center mt-2">
                <x-jet-action-message class="mr-3 bg-green-600 text-white p-1 rounded-lg" on="saved">
                    Registro actualizado con exito
                </x-jet-action-message>

                <x-jet-danger-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                    Actualizar Producto
                    <i class="fas fa-save ml-2"></i>
                </x-jet-danger-button>
                <x-button-enlace href="{{ route('admin.index') }}">
                    Cancelar
                    <i class="fas fa-times ml-2"></i>
                </x-button-enlace>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre sus imagenes aqui.",
                acceptedFiles: 'image/*',
                maxFiles: 4,
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshImage');
                },
                accept: function(file, done) {
                    if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                    } else {
                        done();
                    }
                }
            };

            Livewire.on('deleteProduct', () => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡Esta accion no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, eliminar!',
                    cancelButtonText: 'Cancelar'

                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.edit-product', 'delete');
                        Swal.fire({
                            icon: 'success',
                            title: 'Producto eliminado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            });
        </script>
    @endpush
</div>
