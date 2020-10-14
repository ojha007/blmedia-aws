<div class="news-list-view">
    @foreach($newsByCategory as $news)
        <div class="news-item">
            <div class="fixed-height-img">
                @include('frontend::components.news.news-image')
            </div>
            <div class="news-content">
                @include('frontend::components.news.news-content')
                <ul class="hr-list wide stamp">
                    <li>
                        <i class="fa fa-clock blus "></i>
                        {{\Carbon\Carbon::parse($news->publish_date)->format('Y-m-d')}}
                    </li>
                    @include('frontend::components.news.news-author')
                </ul>
                <p>{!! $news->short_description !!}</p>
                <p>
                    @include('frontend::components.buttons.read-more-button', ['news' => $news])
                </p>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination-wrapper">
    {{ $newsByCategory->links('vendor.pagination.custom') }}
</div>
