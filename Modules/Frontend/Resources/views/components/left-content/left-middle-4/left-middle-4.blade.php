<div class="col-12">
    @if(count($tenthPositionNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$tenthPositionNews])
            <div class="card-block">
                <div class="row row-card">
                    <div class="col-sm-12 col-md-7">
                        @foreach($tenthPositionNews as $key=>$news)
                            @if($key == 0)
                                @include('frontend::components.news.featured-card', ['featuredClass' => 'featured-card'])
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-12 col-md-5">
                        @foreach($tenthPositionNews as $key=>$news)
                            @if($key >0 && $key <=4)
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img'])
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                @include('frontend::components.news.news-title')
                                                @include('frontend::components.news.news-author')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row ">
                    @foreach($tenthPositionNews as $key=>$news)
                        @if($key >4)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img-top'])
                                    <div class="card-body">
                                        @include('frontend::components.news.news-title')
                                        @include('frontend::components.news.news-author')
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @include('frontend::components.buttons.view-all-category-button', ['position' => $tenthPositionNews])
            </div>
        </div>
        {{-- <div class="newsBlock type-3 position-10 front_body_position_10" style="padding: 0 15px;">
             @include('frontend::components.news.category-heading',['allNews'=>$tenthPositionNews])
             <div class="block-body">
                 <div class="row d-block">
                     @foreach($tenthPositionNews as $key=>$news)
                         @if($key == 0)
                             <div class="news-item highlight-news am-kala position-10-highlight">
                                 <div class="featured-img-fixed-height">
                                     @include('frontend::components.news.news-image')
                                 </div>
                                 <div class="news-content">
                                     @include('frontend::components.news.news-content')
                                     <p class="short-news">{!! $news->short_description !!}</p>
                                 </div>
                             </div>
                         @else
                             <div class="news-item am-kala-item p-10-item">
                                 @include('frontend::components.news.news-image')
                                 <div class="news-content">
                                     @include('frontend::components.news.news-content')
                                 </div>
                             </div>
                         @endif
                     @endforeach
                 </div>
             </div>
             @include('frontend::components.buttons.view-all-category-button', ['position' => $tenthPositionNews])
     </div>--}}
    @endif
</div>
