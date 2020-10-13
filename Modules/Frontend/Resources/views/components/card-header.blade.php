<div class="card-header custom-heading">
    <p>
        <a href="{{route($routePrefix.'news-category.show',$header->first()->category_slug)}}">
            {{$header->first()->categories}}
        </a>
    </p>
</div>
