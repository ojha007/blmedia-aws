<div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
    @include('frontend::components.card-header',['header'=>$newsByCategory])
    <div class="card-body ">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                @foreach($newsByCategory as $key=>$news)
                    @if($key == 0)
                        <div class="card mb-3">
                            @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img-top'])
                            <div class="card-body">
                                @include('frontend::components.news.news-title')
                                @include('frontend::components.news.news-author')
                                @include('frontend::components.news.news-short-description')
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="row">
                    @foreach($newsByCategory->take(5) as $key=>$news)
                        @if($key >0)
                            <div class="col-sm-12 col-md-6">
                                <div class="card mb-3">
                                    @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img-top'])
                                    <div class="card-body">
                                        @include('frontend::components.news.news-title')
                                        @include('frontend::components.news.news-author')
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @include('frontend::components.buttons.view-all-category-button', ['position' => $newsByCategory])
    </div>
</div>

{{--<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="big_bx">
            @if(count($newsByCategory))
                @include('frontend::components.news.news-image',['news'=>$newsByCategory->first()])
                <div class="ovrLay">
                    @include('frontend::components.news.news-content',['news'=>$newsByCategory->first()])
                    @include('frontend::components.news.news-author',['news'=>$newsByCategory->first()])
                </div>
                <p>
                    {!! $newsByCategory->first()->short_description !!}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="row">
            @foreach($newsByCategory->take(5) as $key=>$news)
                @if($key > 0)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="small_bx">
                            @include('frontend::components.news.news-image',['figureClass'=>''])
                            @include('frontend::components.news.news-content')
                            @include('frontend::components.news.news-author')
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @if(count($newsByCategory))
        <div class="col col-12">
            @include('frontend::components.buttons.view-all-category-button', ['position' => $newsByCategory])
        </div>
    @endif
</div>--}}
@include('frontend::components.subChild')
