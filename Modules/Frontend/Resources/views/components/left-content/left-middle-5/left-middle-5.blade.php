<div class="newsBlock type-6 position-12 front_body_position_12">
    @if(count($twelvePositionNews))
        @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                        'sub_for'=>$twelvePositionNews->first()->category_slug])
        @include('frontend::components.news.category-heading',['allNews'=>$twelvePositionNews])
        <div class="block-body">
            <div class="row">
                @foreach($twelvePositionNews as $key=>$news)
                    @if($key ==0 )
                        <div class="col-sm-12 col-md-6">
                            <div class="card ">
                                @include('frontend::components.news.news-image',['figureClass'=>'', 'imgClass'=>'card-img-top'])
                                <div class="card-body px-0">
                                    @include('frontend::components.news.news-content')
                                    <p class="card-text">{!! $news->short_description !!}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col eq-highlight">
                             <div class="news-item">
                                 @include('frontend::components.news.news-image',['figureClass'=>''])
                                 <div class="news-content">
                                     @include('frontend::components.news.news-content')
                                     <p class="short-news"> {!! $news->short_description !!}</p>
                                 </div>
                             </div>
                         </div>--}}
                    @endif
                @endforeach
                <div class="col eq-listing">
                    <div class="row">
                        @foreach($twelvePositionNews as $key=>$news)
                            @if($key >0)
                                <div class="news-item">
                                    <div class="fixed-height-img">
                                        @include('frontend::components.news.news-image')
                                    </div>
                                    <div class="news-content">
                                        @include('frontend::components.news.news-content')
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            @include('frontend::components.buttons.view-all-category-button', ['position' => $twelvePositionNews])

            @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                       'sub_for'=>$twelvePositionNews->first()->category_slug])
            @endif
        </div>
</div>
