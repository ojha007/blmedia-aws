<div class="newsBlock type-8 front_body_position_3">

    @if(count($blSpecialNews))
        <div class="block-header gn-heading">
            <h2><a href="">
                    {{trans('message.bl_special')}}
                </a>
            </h2>
        </div>
        <div class="block-body blspecial-body bisheshNew">
            @foreach($blSpecialNews as $news)
                <div class="news-item">
                    <figure class="news-image">
                        <a href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                            {{--<img src="{{$news->image}}" alt="{{$news->image}}"
                                 class="responsive-img" title="">--}}
                            <img src="{{asset('frontend/img/orange.jpg')}}" alt="" class="responsive-img">
                        </a>
                    </figure>
                    <div class="news-content">
                        <h5 class="news-title"><a
                                href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                                {{$news->title}}
                            </a></h5>
                    </div>
                    <ul class="hr-list wide stamp">
                        <li><i class="fa fa-circle blus"></i> blmedia</li>
                    </ul>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $thirdPositionNews])
        </div>
    @endif
</div>

