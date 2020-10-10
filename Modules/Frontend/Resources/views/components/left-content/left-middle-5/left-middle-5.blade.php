<div class="newsBlock type-6 position-12 front_body_position_12">
    @if(count($twelvePositionNews))
        @include('frontend::components.news.category-heading',['allNews'=>$twelvePositionNews])
        <div class="block-body">
            <div class="row">
                @foreach($twelvePositionNews as $key=>$news)
                    @if($key ==0 )
                        <div class="col eq-highlight">
                            <div class="news-item">
                                @include('frontend::components.news.news-image',['figureClass'=>''])
                                <div class="news-content">
                                    @include('frontend::components.news.news-content')
                                    <p class="short-news"> {!! $news->short_description !!}</p>
                                </div>
                            </div>
                        </div>
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
            @endif
        </div>
</div>
