@if(count($breadcrumbs))
    <section class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container-fluid">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route($routePrefix.'index')}}">
                                    {{trans('messages.home')}}
                                </a>
                            </li>
                            @foreach($breadcrumbs as $breadcrumb)
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{route($routePrefix.'news-category.show',$breadcrumb->slug)}}"
                                       itemprop="item">
                                        {{$breadcrumb->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
@endisset
