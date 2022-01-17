<x-app-layout>
    <div class="container flex text-gray-600 text-md py-2">
        <a href="/">Inicio</a> <p class="mx-2">/</p>
        <a href="{{route('categorias.show', $categoria)}}">{{$categoria->nombre}}</a><p class="mx-2">/</p>
    </div>
    <div class="container py-8">
        <Figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($categoria->imagen) }}" alt="">
        </Figure>

        @livewire('category-filter', ['categoria' => $categoria])
    </div>
</x-app-layout>