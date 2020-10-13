@isset($news)
    @if($news->author_type && $news->author_slug)
        <p class="card-text news-author"><small class="text-muted">
                <span><a href="{{route($routePrefix.'news.by.author',[$news->author_type,$news->author_slug])}}" class="hover-site-color">
                    <i class="fa fa-user blus"></i>
                    {{$news->author_name}}
                </a></span>
                <span>@if($news->date_line)
                        ,
                        {{$news->date_line}}
                    @endif</span>
            </small></p>
        {{--<ul class="hr-list wide stamp">
            <li>
                <a href="{{route($routePrefix.'news.by.author',[$news->author_type,$news->author_slug])}}">
                    <i class="fa fa-user blus"></i>
                    {{$news->author_name}}
                </a>
                @if($news->date_line)
                    ,
                    {{$news->date_line}}
                @endif

            </li>
        </ul>--}}
    @endif
@endisset
