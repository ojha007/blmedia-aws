@isset($news)
    @if($news->reporter_slug || $news->guest_slug)
        <div class="hr-list wide stamp float-left">
            <ul>
                <li>
                    @if($news->guest_slug)
                        <a href="{{route($routePrefix.'news.by.author',
                            ['reporter',$news->guest_slug])}}">
                            {{--                            <i class="fa fa-user blus"></i>--}}
                            {{$news->guest_name}}{{$news->date_line ? ' - '.$news->date_line :''}}
                        </a>
                        {{--                        <a href="{{route($routePrefix.'news.by.author',--}}
                        {{--                            ['guests',$news->guest_slug])}}">--}}
                        {{--                            <i class="fa fa-user blus"></i>--}}
                        {{--                            {{$news->guest_name}}--}}
                        {{--                        </a>--}}
                    @elseif($news->reporter_slug)
                        <a href="{{route($routePrefix.'news.by.author',
                            ['reporter',$news->reporter_slug])}}">
                            {{--                            <i class="fa fa-user blus"></i>--}}
                            {{$news->reporter_name}}{{$news->date_line ? ' - '.$news->date_line :''}}
                        </a>
                        {{--                    @elseif($news->guest_slug)--}}
                        {{--                        <a href="{{route($routePrefix.'news.by.author',--}}
                        {{--                            ['guests',$news->guest_slug])}}">--}}
                        {{--                            <i class="fa fa-user blus"></i>--}}
                        {{--                            {{$news->guest_name}} {{$news->date_line ? '-'.$news->date_line :''}}--}}
                        {{--                        </a>--}}
                    @endif
                </li>
                {{--                <li>--}}
                {{--                    @if($news->date_line)--}}
                {{--                        ,--}}
                {{--                        --}}
                {{--                    @endif--}}
                {{--                </li>--}}
            </ul>
        </div>
    @endif

@endisset
