@if(count($firstPositionNews))
    @include('frontend::components.news.news-template3',[
            'allNews'=>$firstPositionNews,
            'positionClass'=>'front_body_position_11'
])
   {{-- <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
        @include('frontend::components.card-header',['header'=>$firstPositionNews])
        <div class="card-block">
            @foreach($firstPositionNews as $news)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'card-img-wrap','imgClass'=>'card-img'])
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @include('frontend::components.news.news-title')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $firstPositionNews])
        </div>
    </div>--}}
{{--    <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
        @include('frontend::components.card-header',['header'=>$firstPositionNews])
        <div class="card-body ">
            @foreach($firstPositionNews as $news)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img'])
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @include('frontend::components.news.news-title')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $firstPositionNews])
        </div>
    </div>--}}
    {{--<div class="newsBlock front_body_position_1 type-1">
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
    </div>--}}


@endif
