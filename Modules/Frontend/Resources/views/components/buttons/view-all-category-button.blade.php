@if(count($position))
    <a href="{{route($routePrefix.'news-category.show',$position->first()->category_slug)}}"
       class="btn  border-0 rounded-0 p-0 btn-viewAll float-right">
        <span>{{trans('messages.view_all')}}</span> <i class="fas fa-angle-right"></i>
    </a>
@endif
