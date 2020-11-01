<section class="header-mid-section">
    <div class="offset-lg-1 col-lg-10 col-sm-12 py-3">
        <div class="row">
            <div class="col-3 col-md-2 col-lg-2 col-xl-2 float-left ">
                <a href="{{route($routePrefix.'index')}}">
                <picture class="brand-logo m-0">
                        <img class=" " src="{{asset('frontend/img/logo.png')}}"
                             alt="BL Media">
                </picture>
                </a>
            </div>
            <div class="col-9 col-md-10 col-lg-10 col-xl-10 float-right d-sm-none d-md-block ">
                @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'aside','sub_for'=>'logo'])
            </div>
        </div>
    </div>
</section>
