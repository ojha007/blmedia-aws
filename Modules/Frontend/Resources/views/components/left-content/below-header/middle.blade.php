@if(count($anchorNews))
    <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
        @include('frontend::components.card-header',['header'=>$firstPositionNews])
        <div class="card-block">
            @foreach($anchorNews as $key=>$news)
                @if($key == 0)
                    @include('frontend::components.news.featured-card', ['featuredClass' => 'featured-card'])
                @else
                    @include('frontend::components.news.horizontal-card')
                @endif
            @endforeach
            @include('frontend::components.buttons.view-all-category-button', ['position' => $anchorNews])
        </div>
    </div>
    {{-- <div class="newsBlock front_body_position_2 type-2 " id="BL_link">
         @include('frontend::components.news.category-heading',['allNews'=>$anchorNews])
         <div class="block-body">
             @foreach($anchorNews as $key=>$news)
                 @if($key == 0)
                     <div class="news-item highlight-news">
                         <div class="featured-img-fixed-height">
                             @include('frontend::components.news.news-image')
                         </div>
                         <div class="news-content">
                             @include('frontend::components.news.news-content')
                             @include('frontend::components.news.news-author')
                             <p> {{$news->short_description}}</p>
                         </div>
                     </div>
                 @else
                     <div class="news-item">
                         <div class="fixed-height-img-2">
                             @include('frontend::components.news.news-image')
                         </div>
                         <div class="news-content">
                             @include('frontend::components.news.news-content')
                             @include('frontend::components.news.news-author')
                             <p>{{$news->short_description}}</p>
                         </div>
                     </div>
                 @endif
             @endforeach
             @include('frontend::components.buttons.view-all-category-button', ['position' => $anchorNews])

         </div>
     </div>--}}

@endif
