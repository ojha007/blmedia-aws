<li class="treeview {{
    request()->is(
            $urlPrefix.'/users',
            $urlPrefix.'/users/*',
            $urlPrefix.'/roles',
            $urlPrefix.'/roles/*'
           )
            ? 'active' : '' }}">
    <a href="#"><i
            class="fa fa-user"></i>
        <span>Users and Roles</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>

    <ul class="treeview-menu" style="">

        <li class="{{  request()->is($urlPrefix.'/users') ? 'active' : '' }}"><a
                href="{{ route($routePrefix.'users.index') }}">
                <i class="fa fa-circle-o"></i> Users
            </a></li>
        <li class="{{  request()->is($routePrefix.'/roles',
                    $routePrefix.'/roles/*') ? 'active' : '' }}"><a
                href="{{ route($routePrefix.'roles.index') }}">
                <i class="fa fa-circle-o"></i>
                Roles</a></li>
    </ul>
</li>



