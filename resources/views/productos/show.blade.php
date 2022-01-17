<x-app-layout>
    <div class="container flex text-gray-600 text-md py-2">
        <a href="/">Inicio <p class="mx-2">/</p></a>
        <a href="{{route('categorias.show', $categoria)}}">{{$producto->subcategoria->categoria->nombre}}</a><p class="mx-2">/</p>
        <a href="{{route('categorias.show', $categoria)}}">{{$producto->subcategoria->nombre}}</a><p class="mx-2">/</p>
        <p>{{$producto->nombre}}</p>
    </div>
    <div class="container py-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="flexslider w-5/6 h-5/6">
                    <ul class="slides">
                        @foreach ($producto->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <h1 class="text-xl font-serif font-bold text-trueGray-900 pt-6">{{ $producto->nombre }}</h1>
                <div class="flex">
                    <p class="text-trueGray-700 font-serif">Marca:
                        <a class="underline capitalize hover:text-orange-600" href="">{{ $producto->marca->nombre }}
                            <img class="w-24 h-12"
                                src="{{ Storage::url($producto->marca->imagen) }}" alt="">
                        </a>
                    </p>
                    <p class="text-trueGray-700 ml-6">5 <i class="fas fa-star text-sm text-yellow-500"></i></p>
                </div>
                <p class="text-2xl font-bold font-sans text-red-600 my-4">$ {{ $producto->precioVenta }}</p>
                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="py-1 px-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-orange-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg text-orange-600"> Envios a todo México</p>
                            <p> Recibelo el {{ Date::now()->addDay(7)->locale('es')->format('l j F') }}</p>
                        </div>
                    </div>
                    <div class="py-1 pl-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-orange-600">
                            <i class="fas fa-store text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg text-orange-600">Recógelo en tienda</p>
                            <div class="flex">
                                <i class="fas fa-map-marker-alt text-orange-600"></i>
                                <p class="ml-2 text-sm">
                                    Blvd. Luis Donaldo Colosio 1281, Col. Lomas de San Agustín, Naucalpan,
                                    Estado de México.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @livewire('add-card-item', ['producto' => $producto])
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
