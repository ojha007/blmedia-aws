<div class="col-12 ">
    @if(count($twelvePositionNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$twelvePositionNews])
            <div class="card-block">
                <div class="row">
                    <div class="col-md-6">
                        @foreach($twelvePositionNews as $key=>$news)
                            @if($key == 0)
                                @include('frontend::components.news.featured-card')
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="row ">
                            @foreach($twelvePositionNews as $key=>$news)
                                @if($key >0)
                                    <div class=" col-md-6">
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
                    </div>
                </div>
                @include('frontend::components.buttons.view-all-category-button', ['position' => $twelvePositionNews])
            </div>
        </div>
        {{--<div class="newsBlock type-6 position-12 front_body_position_12">
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
                                --}}{{-- <div class="col eq-highlight">
                                     <div class="news-item">
                                         @include('frontend::components.news.news-image',['figureClass'=>''])
                                         <div class="news-content">
                                             @include('frontend::components.news.news-content')
                                             <p class="short-news"> {!! $news->short_description !!}</p>
                                         </div>
                                     </div>
                                 </div>--}}{{--
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

                </div>
        </div>--}}
    @endif
</div>
