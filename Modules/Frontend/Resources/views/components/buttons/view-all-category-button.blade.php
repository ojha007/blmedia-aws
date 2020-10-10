@if(count($position))
    <a href="{{route($routePrefix.'news-category.show',$position->first()->category_slug)}}"
       class=" btn btn-viewAll float-right" role="button">{{trans('messages.view_all')}}
    </a>
@endif
