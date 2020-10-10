@foreach($fourthPositionNews as $key=>$news)
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-sm-5 thumbnail">
            <a href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                <i class="far fa-play-circle fa-3x"></i>
                <img src="{{is_null($news->image) ? asset('frontend/img/logo.png') :  $news->image}}"
                     alt="{{$news->image_alt}}"
                     title="{{$news->image_description}}"
                     class="card-img {{$imgClass ?? ''}}">
            </a>
        </div>
        <div class="col-sm-7">
            <div class="card-body py-0 ">
                <a href="{{route($routePrefix.'news.show',$news->news_slug)}}"> <p class="card-text font-weight-bold"> {{\Illuminate\Support\Str::limit($news->title, 70)}}</p></a>
                <a href="http://blmedia.pp/author/guests/hari-3">
                    @include('frontend::components.news.news-author')
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach