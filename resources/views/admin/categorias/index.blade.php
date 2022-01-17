<x-admin-layout>
    <div class="container py-12">
        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Categorias
                </h2>
            </div>
    
        </x-slot>
        @livewire('admin.create-category')
    </div>

    @push('script')
        <script>
            Livewire.on('deleteCategory', categoriaSlug => {
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
                        Livewire.emitTo('admin.create-category', 'delete', categoriaSlug)
                        Swal.fire(
                            '¡Borrado!',
                            'La categoría ha sido borrada con exito',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
    
</x-admin-layout>
