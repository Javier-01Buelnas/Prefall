<div class="container py-12">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight capitalize">
                Municipios ({{ $estado->nombre }})
            </h2>
        </div>
    </x-slot>

    <x-jet-action-section>
        <x-slot name="title" class="mb-6">
            Estados existentes
        </x-slot>
        <x-slot name="description">
            Listado de todas los estados creados
        </x-slot>
        <x-slot name="content">
            <table class="table table-striped table-hover table-condensed">
                <thead class="bg-gradient-to-b from-black to-blueGray-700">
                    <tr class="text-left">
                        <th class="py-2 text-white">#</th>
                        <th class="py-2 text-white">Nombre</th>
                        <th class="py-2 text-white">Costo de Envio</th>
                        <th class="py-2 text-white">Estado</th>
                        <th class="py-2 text-white">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($municipios as $municipio)
                        <tr>
                            <td class="py-2">
                                <span>{{ $municipio->id }}</span>
                            </td>
                            <td class="py-2">
                                <a href="{{ route('admin.municipios.show', $municipio) }}" class="text-black underline capitalize hover:text-orange-600">
                                    {{ $municipio->nombre }} </a>
                            </td>
                            <td class="py-2">
                                <span>${{ $municipio->costo }} MXN</span>
                            </td>
                            <td class="py-2">
                                <span>{{ $municipio->estado->nombre }}</span>
                            </td>
                            <td>
                                <div class="flex divide-x divide-gray-700">
                                    <a class="mr-2 hover:cursor-pointer" wire:click="edit('{{ $municipio->id }}')"><i
                                            class="fas fa-edit"></i></a>
                                    <a class="px-2 hover:cursor-pointer"
                                        wire:click="$emit('deleteMunicipio', '{{ $municipio->id }}')"><i
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
            Crear nuevo estado
        </x-slot>
        <x-slot name="description">
            Complete la información solicitada para crear un nuevo estado
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6">
                <div class="sm:grid sm:grid-cols-2 sm:gap-6">
                    <div class="mb-2">
                        <x-jet-label>Nombre:</x-jet-label>
                        <x-jet-input wire:model.defer="createForm.nombre" type="text" class="w-full" />
                        <x-jet-input-error for="createForm.nombre" class="mt-1" />
                    </div>
                    <div>
                        <x-jet-label>Costo de envio:</x-jet-label>
                        <x-jet-input wire:model.defer="createForm.costo" type="number" step=".01" class="w-full" />
                        <x-jet-input-error for="createForm.costo" class="mt-1" />
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3 bg-green-600 text-white p-1 rounded-lg" on="saved">
                Municipio agregado con exito
            </x-jet-action-message>
            <x-jet-button>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Municipio
        </x-slot>
        <x-slot name="content">
            <div class="sm:grid sm:grid-cols-2 sm:gap-6">
                <div>
                    <x-jet-label>Nombre:</x-jet-label>
                    <x-jet-input wire:model="editForm.nombre" type="text" class="w-full" />
                    <x-jet-input-error for="editForm.nombre" class="mt-1" />
                </div>
                <div>
                    <x-jet-label>Costo de envio:</x-jet-label>
                    <x-jet-input wire:model="editForm.costo" class="w-full" type="number" step=".01" />
                    <x-jet-input-error for="editForm.costo" class="mt-1" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
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
            Livewire.on('deleteMunicipio', municipioId => {
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
                        Livewire.emitTo('admin.show-estado', 'delete', municipioId)
                        Swal.fire(
                            '¡Borrado!',
                            'El estado ha sido borrado con exito',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush


</div>
