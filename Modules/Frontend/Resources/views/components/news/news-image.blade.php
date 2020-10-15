<figure class=" {{ isset($figureClass) ? $figureClass : 'news-image'}}">
    <a href="{{route($routePrefix.'news.show',$news->news_slug ?? $news->slug)}}" class="{{$imageClass ??''}}">
        @if(isset($image))
            <img src="{{
                is_null($image) ?
               asset('frontend/img/logo.png')
               :  $news->$image
               }}"
                 alt="{{$news->image_alt}}"
                 title="{{$news->image_description}}"
                 class=" {{$imgClass ?? 'responsive-img'}}">
        @else
            <img src="{{
                is_null($news->image) ?
               asset('frontend/img/logo.png')
               :  $news->image
               }}"
                 alt="{{$news->image_alt}}"
                 title="{{$news->image_description}}"
                 class=" {{$imgClass ?? 'responsive-img'}}">
        @endif

    </a>
</figure>
