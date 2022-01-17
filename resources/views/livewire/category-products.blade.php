<div wire:init="loadPost">
    @if (count($productos))
        <div class="glider-contain">
            <ul class="glider-{{$categoria->id}}">
                @foreach ($productos as $producto)
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4' }}">
                        <article>
                            <a href="{{route('productos.show', $producto)}}">
                                <figure>
                                    @if ($producto->images->count())
                                        <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($producto->images->first()->url) }}" alt="">
                                    @endif
                                </figure>
                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold">
                                        {{ Str::limit($producto->nombre, 25) }}
                                    </h1>
                                    <p class="font-bold text-orange-700">$ {{ $producto->precioVenta }}</p>
                                </div>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>

            <button aria-label="Previous" class="glider-prev"><i class="fas fa-chevron-circle-left"></i></button>
            <button aria-label="Next" class="glider-next"><i class="fas fa-chevron-circle-right"></i></button>
            <div role="tablist" class="dots"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex items-center justify-center bg-white shadow-xl border border-gray-200">
            <div class="w-20 h-20 border-t-4 border-b-4 border-cyan-900 duration-300 rounded-full animate-spin"></div>
        </div>
    @endif
    

</div>
