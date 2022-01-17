<div class="border my-4">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Productos Existentes
            </h2>
            <x-button-enlace href="{{ route('admin.productos.create') }}" class="ml-auto">Producto
                <i class="fas fa-plus-circle ml-2"></i>
            </x-button-enlace>
        </div>

    </x-slot>
    <div class="py-6 px-12 rounded-xl">
        <div class="p-4 bg-white rounded-2xl">
            <table class="table table-striped table-hover table-bordered table-condensed" id="productos">
                <thead class="bg-gradient-to-b from-black to-blueGray-700">
                    <tr>
                        <th class="align-middle text-white">#</th>
                        <th class="align-middle text-white">Id</th>
                        <th class="align-middle text-white">Nombre</th>
                        <th class="align-middle text-white">Categoria</th>
                        <th class="align-middle text-white">Precio Compra</th>
                        <th class="align-middle text-white">Precio Venta</th>
                        <th class="align-middle text-white">Estado</th>
                        <th class="align-middle text-white">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="text-sm font-medium text-gray-900 align-middle">{{ $producto->id }}</td>
                            <th class="text-sm font-medium text-gray-900 align-middle">{{ $producto->clave }}</th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($producto->images->count())
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ Storage::url($producto->images->first()->url) }}" alt="">
                                        @else
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="https://images.pexels.com/photos/2892619/pexels-photo-2892619.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $producto->nombre }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <th class="text-sm font-medium text-gray-900 align-middle">
                                {{ $producto->subcategoria->categoria->nombre }}</th>
                            <th class="text-sm font-medium text-gray-900 align-middle">${{ $producto->precioCompra }}
                            </th>
                            <th class="text-sm font-medium text-gray-900 align-middle">${{ $producto->precioVenta }}
                            </th>
                            <th class="align-middle px-6 py-4 whitespace-nowrap">
                                @switch($producto->estado)
                                    @case(1)
                                        <span
                                            class="px-2 inline-flex leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                            Borrador
                                        </span>
                                    @break
                                    @case(2)
                                        <span
                                            class="px-2 py-1 inline-flex leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                            Publicado
                                        </span>
                                    @break
                                    @default

                                @endswitch
                            </th>

                            <th class="align-middle">
                                <div class="flex divide-x divide-gray-700">
                                    <a href="{{ route('admin.productos.edit', $producto) }}" class="mr-2">
                                        <i class="fas fa-edit text-xl"></i>
                                    </a>

                                    <a wire:click="$emit('deleteProduct', '{{ $producto->slug }}')" class=" hover:cursor-pointer pl-2">
                                        <i class="fas fa-trash text-xl text-red-600"></i>
                                    </a>
                                </div>
                            </th>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @push('script')
        <script>
            $('#productos').DataTable({
                responsive: true,
                autoWidth: false,

                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Sin registros a mostrar - Lo sentimos ",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            Livewire.on('deleteProduct', productoSlug => {
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
                        Livewire.emitTo('admin.show-products', 'delete', productoSlug);
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
