<div class="col-12">
    @if(count($baseAllNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$baseAllNews])
            <div class="card-block">
                <div class="row">
                    <div class="col-md-6">
                        @foreach($baseAllNews as $key=>$news)
                            @if($key == 0)
                                @include('frontend::components.news.featured-card', ['featuredClass' => 'featured-card'])
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($baseAllNews as $key=>$news)
                                @if($key >0 && $key <=4)
                                    <div class="col-md-6">
                                        @include('frontend::components.news.vertical-card', ['verticalClass' => 'vertical-card'])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($baseAllNews as $key=>$news)
                        @if($key >=5)
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        @include('frontend::components.news.news-title')
                                        @include('frontend::components.news.news-author')
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @include('frontend::components.buttons.view-all-category-button', ['position' => $baseAllNews])
            </div>
        </div>
        {{--<div class="newsBlock type-3 front_body_position_8" style="padding: 0 15px;">

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

        </div>--}}
    @endif
</div>