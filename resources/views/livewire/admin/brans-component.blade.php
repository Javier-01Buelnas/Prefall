<div class="container py-12">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Marcas
            </h2>
        </div>
    </x-slot>

    <x-jet-action-section>
        <x-slot name="title" class="mb-6">
            Marcas existentes
        </x-slot>
        <x-slot name="description">
            Listado de todas las marcas creadas
        </x-slot>
        <x-slot name="content">
            <table class="table table-striped table-hover table-condensed">
                <thead class="bg-gradient-to-b from-black to-blueGray-700">
                    <tr class="text-left">
                        <th class="py-2 text-white">#</th>
                        <th class="py-2 w-full text-white">Nombre</th>
                        <th class="py-2 text-white">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td class="py-2">
                                <span class="text-orange-600 text-center">{!! $marca->id !!}</span>
                            </td>
                            <td class="flex items-center py-2">
                                <span class="mr-2"><img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ Storage::url($marca->imagen) }}" alt=""></span>
                                <span class="text-black hover:text-orange-600"> {{ $marca->nombre }} </span>
                            </td>
                            <td>
                                <div class="flex divide-x divide-gray-700">
                                    <a class="mr-2 hover:cursor-pointer"
                                        wire:click="edit('{{ $marca->id }}')"><i class="fas fa-edit"></i></a>
                                    <a class="px-2 hover:cursor-pointer"
                                        wire:click="$emit('deleteMarca', '{{ $marca->id }}')"><i
                                            class="fas fa-trash text-red-600"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    <x-jet-form-section submit="save">
        <x-slot name="title">
            Crear nueva marca
        </x-slot>
        <x-slot name="description">
            Complete la informaci??n solicitada para crear una nueva marca
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6">
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <x-jet-label>Nombre:</x-jet-label>
                        <x-jet-input wire:model="createForm.nombre" type="text" class="w-full" />
                        <x-jet-input-error for="createForm.nombre" class="mt-1" />
                    </div>
                    <div class="col-span-2"> 
                        <x-jet-label>Imagen de la marca:</x-jet-label>
                        <x-jet-input wire:model="createForm.imagen" type="file" id="{{$rand}}" accept="image/*" />
                        <x-jet-input-error for="createForm.imagen" class="mt-1" />
                    </div>
                </div>
                
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3 bg-green-600 text-white p-1 rounded-lg" on="saved">
               Marca agregada con exito
            </x-jet-action-message>
            <x-jet-button>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Marca
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label>Nombre:</x-jet-label>
                    <x-jet-input wire:model="editForm.nombre" type="text" class="w-full" />
                    <x-jet-input-error for="editForm.nombre" class="mt-1" />
                </div>
                <div>
                    <x-jet-label>Imagen de la marca:</x-jet-label>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{ $editImage->temporaryUrl() }}" alt="">
                    @else
                        <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editForm['imagen']) }}" alt="">
                    @endif
                </div>
                <div>
                    <x-jet-label>Cambiar imagen:</x-jet-label>
                    <x-jet-input wire:model="editImage" type="file" id="{{ $rand2 }}" accept="image/*" />
                    <x-jet-input-error for="editImage" class="mt-1" />
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
                <i class="fas fa-save ml-2"></i>
            </x-jet-button>
            <x-jet-danger-button wire:click="open">
                Cancelar
                <i class="fas fa-times ml-2"></i>
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('script')
    <script>
        Livewire.on('deleteMarca', marcaId => {
            Swal.fire({
                title: '??Estas seguro?',
                text: "??Esta accion no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '??Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.brans-component', 'delete', marcaId)
                    Swal.fire(
                        '??Borrado!',
                        'La marca ha sido borrada con exito',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush
</div>
