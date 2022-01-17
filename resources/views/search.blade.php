<x-app-layout>
    <div class="container my-8">
        <div class="md:col-span-2 lg:col-span-4">
            <p class="text-2xl text-trueGray-900 font-bold font-serif text-left my-8">Resultados de la busqueda</p>

            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-10 border-t-4  mx-8">
                @forelse ($productos as $producto)
                    <x-producto-grid :producto="$producto" />
                @empty
                    <li class="md:col-span-2 lg:col-span-4 bg-white rounded-lg shadow-2xl mt-10 ">
                        <div class="p-8 flex flex-col items-center">
                            <p class="text-lg text-trueGray-900 font-bold font-serif">Resultados de la
                                busqueda
                            </p>
                            <p class="text-sm text-trueGray-700 font-serif">No hay productos que concuerden
                                con la busqueda</p>
                            <a class="bg-orange-600 px-4 py-2 mt-4 text-white rounded-lg" href="/">Volver al inicio</a>
                        </div>

                    </li>
                @endforelse

            </ul>
            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
