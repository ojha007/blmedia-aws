@foreach($allNews as $key=>$news)
    @if($key <6)
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 my-3 videoCard">
            <div class="card ">
                <div class="img-hover-zoom img-hover-zoom--point-zoom">
                    <a href="{{route($routePrefix.'news.show',$news->news_slug)}}" class="thumbnail">
                        <i class="far fa-play-circle fa-3x"></i>
                        <img src="{{is_null($news->image) ? asset('frontend/img/logo.png') :  $news->image}}"
                              alt="{{$news->image_alt}}"
                              title="{{$news->image_description}}"
                              class="card-img-top {{$imgClass ?? ''}}"
                              style="min-height: 200px;"
                        >
                    </a>
                </div>
                <div class="card-body">
                    @include('frontend::components.news.news-title')
                    @include('frontend::components.news.news-author')
                   {{-- <h5 class="card-title m-0 p-0"><a href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                            {{\Illuminate\Support\Str::limit($news->title, 70)}}
                        </a></h5>
                    <p class="card-text">{{$news->image_description}}</p>
                    <div style="margin-top: -15px;">@include('frontend::components.news.news-author')</div>
                </div>
            </div>
        </div>
    @endif
@endforeach
