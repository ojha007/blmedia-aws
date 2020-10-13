@if(count($thirteenPositionNews))
    <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
        @include('frontend::components.card-header',['header'=>$thirteenPositionNews])
        <div class="card-body ">
            @foreach($thirteenPositionNews as $key=>$news)
                @if($key == 0)
                    <div class="card text-white overlay-main ">
                        @include('frontend::components.news.news-image',['imgClass'=>'card-img'])
                        <div class="card-img-overlay d-flex flex-column ">
                            <p class="mt-auto ">
                                <a href="{{route($routePrefix.'news.show',$news->news_slug)}}" class="text-white">
                                    @isset($limit)
                                        {{\Illuminate\Support\Str::limit($news->title, $limit)}}
                                    @else
                                        {!! $news->title !!}
                                    @endisset
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row">
                @foreach($thirteenPositionNews as $key=>$news)
                    <div class="col-sm-12 col-md-4">
                        <div class="card mb-3">
                            @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img-top'])
                            <div class="card-body">
                                @include('frontend::components.news.news-title')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('frontend::components.buttons.view-all-category-button', ['position' => $thirteenPositionNews])
        </div>
    </div>
    {{--<div class="newsBlock front_body_position_13 above-footer type-5 position-13" style="padding: 0 15px;">
        @include('frontend::components.news.category-heading',['allNews'=>$thirteenPositionNews])
        <div class="block-body">
            <div class="row d-block">
                @foreach($thirteenPositionNews as $key=>$news)
                    @if($key == 0)
                        <div class="card text-white overlay-main ">
                            @include('frontend::components.news.news-image',['imgClass'=>'card-img'])
                            <div class="card-img-overlay d-flex flex-column " >
                                <p class="mt-auto ">
                                    <a href="{{route($routePrefix.'news.show',$news->news_slug)}}" class="text-white">
                                        @isset($limit)
                                            {{\Illuminate\Support\Str::limit($news->title, $limit)}}
                                        @else
                                            {!! $news->title !!}
                                        @endisset
                                    </a>
                                </p>
                            </div>
                        </div>
                        --}}{{--<div class="news-item highlight-news overlay-parent">
                            @include('frontend::components.news.news-image',['figureClass'=>'ghumphir-am-bl news-image'])
                            <div class="news-content-overlay">
                                <div class="news-content am-content-blam">
                                    <p class="news-title {{$contentClass ?? ''}}">
                                        <a href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                                            @isset($limit)
                                                {{\Illuminate\Support\Str::limit($news->title, $limit)}}
                                            @else
                                                {!! $news->title !!}
                                            @endisset
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>--}}{{--
                    @else
                        <div class="news-item">
                            <div class="fixed-height-img">
                                @include('frontend::components.news.news-image')
                            </div>
                            <div class="news-content">
                                @include('frontend::components.news.news-content')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @include('frontend::components.buttons.view-all-category-button', ['position' => $thirteenPositionNews])
        </div>
    </div>--}}
@endif
