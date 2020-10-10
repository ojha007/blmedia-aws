@if(count($allNews))
    <div class="block-header gn-heading">
        <h2>
            <a href="{{route($routePrefix.'news-category.show',$allNews->first()->category_slug)}}">
                {{$allNews->first()->categories}}
            </a>
        </h2>
    </div>
@endif

