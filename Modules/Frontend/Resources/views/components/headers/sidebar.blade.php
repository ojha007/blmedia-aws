<div class="col-sm-4 col-md-3 mySidebar" id="mySidebar">
    <ul class="navbar-nav ">
        @foreach($headerCategories as $category)
            <li class="nav-item {{
                                                         request()->is(
                                                             $urlPrefix.'category/'.$category->slug,
                                                             $urlPrefix.'category/'.$category->slug.'/*'
                                                             )
                                                     ? 'active':''}}">
                <a href="{{route($routePrefix.'news-category.show',$category->slug)}}"
                   class="nav-link hover-site-color">
                    {{$category->name}}
                </a>
            </li>
        @endforeach
    </ul>

    {{--<div class="list-group">
        <span href="#" class="list-group-item active">
            Submenu
            <span class="pull-right" id="slide-submenu">
                <i class="fa fa-times"></i>
            </span>
        </span>
        <a href="#" class="list-group-item">
            <i class="fa fa-comment-o"></i> Lorem ipsum
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-search"></i> Lorem ipsum
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-user"></i> Lorem ipsum
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-bar-chart-o"></i> Lorem ipsumr <span class="badge">14</span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-envelope"></i> Lorem ipsum
        </a>
    </div>--}}
</div>