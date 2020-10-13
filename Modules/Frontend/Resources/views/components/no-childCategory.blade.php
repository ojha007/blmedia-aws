@foreach($newsByCategory as $news)
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img'])
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    @include('frontend::components.news.news-title')
                    @include('frontend::components.news.news-author')
                    @include('frontend::components.news.news-short-description')
                    @include('frontend::components.buttons.read-more-button', ['news' => $news])
                </div>
            </div>
        </div>
    </div>
@endforeach

{{--<div class="news-list-view">
    @foreach($newsByCategory as $news)
        <div class="news-item">
            <div class="fixed-height-img">
                @include('frontend::components.news.news-image')
            </div>
            <div class="news-content">
                @include('frontend::components.news.news-content')
                <ul class="hr-list wide stamp">
                    <li>
                        <i class="fa fa-clock-o"></i>
                        {{\Carbon\Carbon::parse($news->publish_date)->format('Y-m-d')}}
                    </li>
                    @if($news->author_type && $news->author_slug)
                        <li>

                            <a href="{{route($routePrefix.'news.by.author',[$news->author_type,$news->author_slug])}}">
                                <i class="fa fa-user"></i>
                                {{$news->author_name}}
                            </a>

                        </li>
                    @endif
                </ul>
                <p>{!! $news->short_description !!}</p>
                <p>
                    @include('frontend::components.buttons.read-more-button', ['news' => $news])
                </p>
            </div>
        </div>
    @endforeach
</div>--}}
<div class="pagination-wrapper">
    {{ $newsByCategory->links('vendor.pagination.custom') }}
</div>
