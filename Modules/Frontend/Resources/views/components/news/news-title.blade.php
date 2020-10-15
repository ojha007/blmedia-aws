@isset($news)
    <p class="card-title {{ isset($contentClass) ? $contentClass : 'news-title' }} ">
        <a href="{{route($routePrefix.'news.show',$news->news_slug)}}" class="hover-site-color">
            @isset($limit)
                {{\Illuminate\Support\Str::limit($news->title, $limit)}}
            @else
                {!! $news->title !!}
            @endisset
        </a>
    </p>
@endisset

