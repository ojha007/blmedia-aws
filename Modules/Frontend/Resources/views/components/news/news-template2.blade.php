<div class="newsBlock type-8 {{$class ?? ''}}" id="bl-break-section-01 ">
    @if(count($allNews))
        <div class="container-fluid text-center">
            @include('frontend::components.ads.ads-2',[
                                'ads'=>$allAds,'placement'=>'above',
                                'sub_for'=>$allNews->first()->category_slug
                                    ])
        </div>
        @include('frontend::components.news.category-heading')
        <div class="block-body">
            @foreach($allNews as $key=>$news)
                @if($key==0)
                    <div class="news-item highlight-news">
                        <div class="ggl_adBlk _300x600 vr-block ">
                            @include('frontend::components.news.news-image',['figureClass'=>''])
                            <div class="news-content-am">
                                @include('frontend::components.news.news-content',['class'=>'news-title-am'])
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>

                    </div>
                @else
                    <div class="news-item breakNew">
                        <div class="fixed-height-img-2">
                            @include('frontend::components.news.news-image')
                        </div>
                        <div class="news-content">
                            @include('frontend::components.news.news-content')
                            @include('frontend::components.news.news-author')

                        </div>
                    </div>
                @endif

            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])
        </div>
        <div class="container-fluid text-center">
            @include('frontend::components.ads.ads-2',[
                                'ads'=>$allAds,'placement'=>'below',
                                'sub_for'=>$allNews->first()->category_slug
                                    ])
        </div>
    @endif

</div>
