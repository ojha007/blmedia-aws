<div class="col-12 ">
    @if(count($twelvePositionNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$twelvePositionNews])
            <div class="card-block">
                <div class="row ">
                    <div class="col-12 col-carousel">
                        <div class="owl-carousel carousel-main index-carousel">
                            @foreach($twelvePositionNews as $key=>$news)
                                <div class="card">
                                    @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img'])
                                    <div class="card-img-overlay  d-flex align-items-end" >
                                        @include('frontend::components.news.news-title')
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @include('frontend::components.buttons.view-all-category-button', ['position' => $twelvePositionNews])
            </div>
        </div>
    @endif
</div>

@push('scripts')

    <script>
        $('.carousel-main').owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            autoplayTimeout: 1500,
            autoplayHoverPause:true,
            margin: 10,
            nav: true,
            dots: false,
            navText: ['<span class="fas fa-chevron-circle-left "></span>','<span class="fas fa-chevron-circle-right "></span>'],
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    loop:true
                },
                600:{
                    items:3,
                    nav:true,
                    loop:true
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:true
                }
            }
        })
    </script>
@endpush