@if(count($allNews))
    <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
        @include('frontend::components.card-header',['header'=>$allNews])
        <div class="card-body text-primary">
            @foreach($allNews as $news)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img'])
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @include('frontend::components.news.news-title')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])
        </div>
    </div>
    {{--<div class="newsBlock type-8 ">
        <div class="block-header gn-heading">
            <h2>
                <a href="{{route($routePrefix.'news-category.show',$allNews->first()->category_slug)}}">
                    {{$allNews->first()->categories}}
                </a>
            </h2>

        </div>
        <div class="block-body {{$bodyClass ?? ''}}">
            @foreach($allNews as $news)
                @php($class ='')
                <div class="news-item">
                    <div class="fixed-height-img-2">
                        @include('frontend::components.news.news-image')
                    </div>
                    <div class="news-content">
                        @include('frontend::components.news.news-content')
                        @include('frontend::components.news.news-author')
                    </div>
                </div>
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])

        </div>
    </div>--}}
@endif
