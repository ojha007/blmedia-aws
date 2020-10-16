<section class="header-mid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 float-left">
                <figure class="brand-logo">
                    <a href="{{route($routePrefix.'index')}}">
                        <img class="responsive-img" id="logo_image_nav"
                             src="{{asset('frontend/img/logo.png')}}"
                             alt="BL Media">
                    </a>
                </figure>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-10 col-xl-10 float-right d-sm-none d-md-block px-0">
                @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'aside','sub_for'=>'logo'])
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
