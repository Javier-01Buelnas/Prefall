<div class="container my-8">
    <div class="glider-contain">
        <ul class="glider">
            @foreach ($marcas as $marca)
                <li class="p-4">
                    <figure>
                        <img class="h-12 w-full object-cover object-center"
                            src="{{ Storage::url($marca->imagen) }}" alt="">
                    </figure>
                </li>
            @endforeach
        </ul>

        <button aria-label="Previous" class="glider-prev">«</button>
        <button aria-label="Next" class="glider-next">»</button>
        <div role="tablist" class="dots"></div>
    </div>

    @push('script')
        <script>
            new Glider(document.querySelector('.glider'), {
                slidesToShow: 5,
                slidesToScroll: 1,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                }
            });
        </script>
    @endpush
</div>
