@if(count($allNews))
    <div class="newsBlock type-8 front_body_position_3 ">
        {{--        <div class="block-header gn-heading">--}}
        {{--            <h2><a href="">--}}
        {{--                    {{$allNews->first()->categories}}--}}
        {{--                </a>--}}
        {{--            </h2>--}}
        {{--        </div>--}}
        @include('frontend::components.news.category-heading')
        <div class="block-body {{$class ?? ''}}">
            @foreach($allNews as $news)
                <div class="news-item">
                    @include('frontend::components.news.news-image')
                    @include('frontend::components.news.news-content')
                    @include('frontend::components.news.news-author')
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])
        </div>
    </div>
@endif
