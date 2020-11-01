<div class="col-12 px-0">
    @if(count($allNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$allNews])
            <div class="card-block">
                @foreach($allNews as $news)
                    <div class="card mb-3">
                        <div class="row ">
                            <div class="col-12">
                                <div class="card-body ">
                                    @isset($news)
                                        <p class="card-title {{ isset($contentClass) ? $contentClass : 'news-title' }} ">
                                            <span class=" ol-style ">{{ $loop->iteration}}.</span>
                                            <a href="{{route($routePrefix.'news.show',$news->news_slug)}}" class="hover-site-color">
                                                @isset($limit)
                                                    {{\Illuminate\Support\Str::limit($news->title, $limit)}}
                                                @else
                                                    {!! $news->title !!}
                                                @endisset
                                            </a>
                                        </p>
                                    @endisset
                                    @include('frontend::components.news.news-author')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])
            </div>
        </div>
    @endif
</div>
