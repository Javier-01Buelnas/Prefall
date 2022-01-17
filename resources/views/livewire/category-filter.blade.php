<div>
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-2 flex justify-between items-center">

            <h1 class="font-bold font-serif text-xl text-gray-700">
                <i class="fas fa-caret-right text-orange-600"></i>
                {{ $categoria->nombre }}
            </h1>
            <div class="grid grid-cols-2 divide-x divide-gray-3">
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-orange-600' : '' }}"
                    wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-orange-600' : '' }}"
                    wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>

            <p class="font-semibold font-serif text-orange-600 border-b-4 border-orange-600 p-1 mb-4">FILTRADO POR</p>
            <h2 class="font-semibold font-serif mb-2">Categorias</h2>
            <ul class="ml-2 mb-2">
                @foreach ($categoria->subcategorias as $subcategoria)
                    <li>
                        <i class="fas fa-dot-circle text-sm text-orange-600"></i>
                        <a wire:click="$set('subcategory', '{{ $subcategoria->slug }}')"
                            class="font-serif text-sm cursor-pointer hover:text-orange-600 {{ $subcategory == $subcategoria->slug ? 'text-orange-600 font-semibold font-serif' : '' }}">
                            {{ $subcategoria->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="font-semibold font-serif mt-4 mb-2 border-t border-trueGray-700 pt-4">Marcas</h2>
            <ul class="ml-2">
                @foreach ($categoria->marcas as $marca)
                    <li>
                        <i class="fas fa-dot-circle text-sm text-orange-600"></i>
                        <a wire:click="$set('brand', '{{ $marca->nombre }}')"
                            class="font-serif text-sm cursor-pointer hover:text-orange-600  {{ $brand == $marca->nombre ? 'text-orange-600 font-semibold font-serif' : '' }}">
                            {{ $marca->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <x-jet-button class="mt-4" wire:click="limpiar">
                Eliminar filtros
            </x-jet-button>
        </aside>
        <div class="md:col-span-2 lg:col-span-4">
            {{-- Listado  en Grid --}}
            @if ($view == 'grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($productos as $producto)
                        <x-producto-grid :producto="$producto" />
                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border-t-4 border-red-500 dark:bg-red-200 dark:text-red-800"
                                role="alert">
                                <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <span class="font-medium">Upss!</span> Sin productos que mostrar aun
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            @else
                {{-- listado en lista --}}
                <ul>
                    @forelse ($productos as $producto)
                        <x-producto-lista :producto="$producto" />
                    @empty
                        <li>
                            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border-t-4 border-red-500 dark:bg-red-200 dark:text-red-800"
                                role="alert">
                                <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <span class="font-medium">Upss!</span> Sin productos que mostrar aun
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            @endif
            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</div>
