@if(count($firstPositionNews))
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                        'sub_for'=>$firstPositionNews->first()->category_slug])
    <div class="newsBlock front_body_position_1 type-1">
        @include('frontend::components.news.category-heading',['allNews'=>$firstPositionNews])
        <div class="block-body">
            @foreach($firstPositionNews as $news)
                <div class="news-item">
                    @include('frontend::components.news.news-image',['image'=>'reporter_image'])
                    <div class="news-content new-type-1">
                        @include('frontend::components.news.news-content')
                        @include('frontend::components.news.news-author')
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $firstPositionNews])
        </div>

    </div>
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                            'sub_for'=>$firstPositionNews->first()->category_slug])
@endif
