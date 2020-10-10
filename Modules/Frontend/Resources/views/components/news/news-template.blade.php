@if(count($allNews))
    <div class="newsBlock type-8 ">
        <div class="block-header gn-heading">
            <h2>
                <a href="{{route($routePrefix.'news-category.show',$allNews->first()->category_slug)}}">
                    {{$allNews->first()->categories}}
                </a>
            </h2>

        </div>
        <div class="block-body {{$bodyClass ?? ''}}">
            @foreach($allNews as $news)
                @php($class ='')
                <div class="news-item">
                    <div class="fixed-height-img-2">
                        @include('frontend::components.news.news-image')
                    </div>
                    <div class="news-content">
                        @include('frontend::components.news.news-content')
                        @include('frontend::components.news.news-author')
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])

        </div>
    </div>
@endif
