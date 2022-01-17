<x-app-layout>
    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="{{ asset('img/a1.png') }}" />
            </li>
            <li>
                <img class="h-12 w-12" src="{{ asset('img/b.jpg') }}" />
            </li>
            <li>
                <img src="{{ asset('img/c.jpg') }}" />
            </li>
        </ul>
    </div>


    <div class="container pb-4">
        <p class="text-center text-orange-600 text-3xl italic font-extrabold">Categorías</p>
        @if (count($categoria))

            @foreach ($categorias as $categoria)
                <section class="mb-6">
                    <div class="flex items-center mb-2">
                        <h1 class="font-bold font-serif text-xl text-gray-700">
                            {{ $categoria->nombre }}
                        </h1>
                        <a href="{{ route('categorias.show', $categoria) }}"
                            class="text-orange-600 ml-2 font-semibold hover:text-orange-400 hover:underline">Ver más</a>
                    </div>

                    @livewire('category-products', ['categoria' => $categoria])
                </section>
            @endforeach
        @endif
    </div>
    @if (count($marcas))


        <div class="container mb-8">
            <p class="text-center font-semibold text-lg font-serif">Gran variendad de productos disponibles,</p>
            <p class="text-center text-lg font-serif">de las mejores marcas especializadas:</p>
            @livewire('marcas', ['marcas' => $marcas])
            <p class="text-center text-lg font-serif"><span class="font-bold mr-2">Herramientas</span>con la mejor
                relación
                calidad-precio</p>
        </div>
    @endif

    @push('script')
        <script>
            livewire.on('glider', function(id) {
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [{
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        }
                    ]
                });
            });

            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide"
                });
            });
        </script>
    @endpush
</x-app-layout>
