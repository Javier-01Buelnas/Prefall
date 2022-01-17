<x-app-layout>
  
    {{-- productos --}}
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols- xl:grid-cols-5 xl:gap-x-8 mb-8">
                @foreach ($productos as $producto)
                    <a class="shadow-xl hover:opacity-90" href="{{ route('productos.show', $producto) }}"
                        class="group">
                        <div
                            class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-md overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                            <img src="{{ Storage::url($producto->foto1) }}"
                                alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                                class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-4 text-lg leading-8 font-bold text-blak">
                            {{ $producto->nombre }}
                        </h3>
                        <p class="mt-1 text-md leading-8 font-bold text-orange-600">
                            $ {{ $producto->precioVenta }}
                        </p>
                        <button type="button" class="bg-orange-600 p-2 text-white rounded-2xl mx-10 mb-2">Añadir a
                            carrito</button>
                    </a>
                @endforeach
            </div>

            {{ $productos->links() }}
        </div>
    </div>

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
   

</x-app-layout>
