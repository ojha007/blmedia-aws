<section class="amnavnd header-end ">
    <div class="container-fluid">
        <div class="row" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            <div class="col-md-2 col-lg-2 hiderfixed_navbar12">
                <a class="navbar-brand  hiderfixed_navbar-brand" href="{{route($routePrefix.'index')}}">
                    <img class="responsive-img" id="logo_image_nav" src="{{asset('frontend/img/logo.png')}}"
                         alt="BL Media">
                </a>
            </div>
            <div class="col-md-4 col-lg-0 col-xl-4 nav-pills-float">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <form class="form-inline base-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="search" name="newsSearch" class="form-control px-0"
                                           placeholder="Search...">
                                    <div class="input-group-append">
                                        <button type="submit" name="search" class="btn btn-trans"><i
                                                class="fa fa-search"
                                                style="font-size: 10px; margin-top: 13px; padding-left: 20px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 col-lg-10 p-0">
                <nav class="navbar navbar-expand-lg navbar-light primary-nav navbar_fixed" id="stickyAM">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#primaryNav"
                            aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="primaryNav">
                        <ul class="navbar-nav">
                            <li class="nav-item  home-site-logo-home
                                                    {{
                                                         request()->is(
                                                             $urlPrefix,
                                                             $urlPrefix.'/'
                                                             )
                                                     ? 'active':''}}">
                                <a href="{{route($routePrefix.'index')}}" class="nav-link"><i
                                        class="fa fa-home"></i> <span class="sr-only">Home</span>
                                </a>
                            </li>
                            <li class="nav-item  home-site-logo">
                                <a class="nav-link navbar-brand-img-logo  " href="{{route($routePrefix.'index')}}">
                                    <img class="responsive-img" id="logo_image_nav"
                                         src="{{asset('frontend/img/logo.png')}}" alt="BL Media">
                                </a>
                            </li>

                            @foreach($headerCategories as $category)
                                <li class="nav-item {{
                                                         request()->is(
                                                             $urlPrefix.'category/'.$category->slug,
                                                             $urlPrefix.'category/'.$category->slug.'/*'
                                                             )
                                                     ? 'active':''}}">
                                    <a href="{{route($routePrefix.'news-category.show',$category->slug)}}"
                                       class="nav-link" style="padding: 0.8em 1.2em !important">
                                        <nobr>
                                            {{$category->name}}
                                        </nobr>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </nav>

            </div>
            <div class="col-md-12 col-lg-2 pl-0">
                <ul class="follow-social-media">
                    <li>
                        <a href="https://www.facebook.com/breaknlinksnp/" target="_blank">
                            <i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/breaknlinksnp" target="_blank">
                            <i class="fab fa-twitter-square"></i></a>
                    </li>
                    <li>
                        <a href="https://instagram.com/breaknlinksnp?igshid=117phr5litq3d" target="_blank">
                            <i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UC88oI8rfTs8LwgQrH3JU7Tw" target="_blank">
                            <i class="fab fa-youtube-square"></i></a>
                    </li>
                    @if(isset($edition) && $edition =='nepali')
                        <li class="unicode-am">
                            |
                            <a href="{{route($routePrefix.'preeti-to-unicode')}}" target="_blank">
                                <i class="fa fa-keyboard"></i> युनिकोड</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid text-center">
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below','sub_for'=>'logo_and_menu'])
</div>



