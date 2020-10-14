<div class="newsBlock type-3 front_body_position_8" style="padding: 0 15px;">
    @if(count($baseAllNews))
        @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                               'sub_for'=>$baseAllNews->first()->category_slug])
        @include('frontend::components.news.category-heading',['allNews'=>$baseAllNews])
        <div class="block-body">
            <div class="row d-block">
                @foreach($baseAllNews as $key=>$news)
                    @if($key == 0)
                        <div class="news-item highlight-news news-am-hl">
                            <div class="featured-img-fixed-height">
                                @include('frontend::components.news.news-image',['imgClass'=>'card-img-top'])
                            </div>
                            <div class="news-content">
                                @include('frontend::components.news.news-content')
                                @include('frontend::components.news.news-author')
                                <p class="short-news"> {!! $news->short_description !!}</p>
                            </div>
                        </div>
                    @else
                        <div class="news-item am-news-item">
                            <div class="fixed-height-img-2">
                                @include('frontend::components.news.news-image')
                            </div>
                            <div class="news-content">
                                @include('frontend::components.news.news-content',['limit'=>40])
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    @endif
                @endforeach
                @include('frontend::components.buttons.view-all-category-button', ['position' => $baseAllNews])
            </div>
        </div>
        @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                          'sub_for'=>$baseAllNews->first()->category_slug])
    @endif
</div>
