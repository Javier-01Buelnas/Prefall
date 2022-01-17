@props(['categoria'])
<div class="grid grid-cols-4 p-4">
    <div>
        <ul>
            <p class="font-semibold mb-2">{{$categoria->nombre}}</p>
            @foreach ($categoria->subcategorias as $subcategoria)
                <li>
                    <a href="{{route('categorias.show', $categoria) . '?subcategory=' . $subcategoria->slug}}" class="text-trueGray-600 inline-block font-semibold py-1 px-4 hover:text-orange-600">
                        <i class="fas fa-caret-right mr-1 text-orange-600"></i>
                        {{$subcategoria->nombre}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-span-3">
        <img class="h-64 w-full object-cover object-center" src="{{Storage::url($categoria->imagen)}}" alt="">
    </div>
</div>