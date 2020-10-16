@isset($news)
    @if(property_exists($news,$reporter_slug) || property_exists($news,$guest_slug))
        <div class="hr-list wide stamp float-left">
            <ul>
                <li>
                    @if(property_exists($news,$reporter_slug) && property_exists($news,$guest_slug))
                        <a href="{{route($routePrefix.'news.by.author',
                            ['reporter',$news->reporter_slug])}}">
                            <i class="fa fa-user blus"></i>
                            {{$news->reporter_name}}
                        </a>
                        <a href="{{route($routePrefix.'news.by.author',
                            ['guests',$news->guest_slug])}}">
                            <i class="fa fa-user blus"></i>
                            {{$news->guest_name}}
                        </a>
                    @elseif(property_exists($news,$reporter_slug))
                        <a href="{{route($routePrefix.'news.by.author',
                            ['reporter',$news->reporter_slug])}}">
                            <i class="fa fa-user blus"></i>
                            {{$news->reporter_name}}
                        </a>
                    @elseif( property_exists($news,$guest_slug))
                        <a href="{{route($routePrefix.'news.by.author',
                            ['guests',$news->guest_slug])}}">
                            <i class="fa fa-user blus"></i>
                            {{$news->guest_name}}
                        </a>
                    @endif
                </li>
                <li>
                    @if($news->date_line)
                        <i class="fa fa-map-marker blus"></i>
                        {{$news->date_line}}
                    @endif
                </li>
            </ul>
        </div>
    @endif

@endisset
