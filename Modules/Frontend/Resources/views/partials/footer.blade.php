@isset($allAds)
    <section class="ads-section pb-3">
        <div class="container-fluid text-center">
            @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                                'sub_for'=>'footer'])
        </div>
    </section>
@endisset
<!--start page footer-->
{{--<footer class="page-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 float-left">
                <div class="footer-brand">
                    <figure class="brand-logo">
                        <img src="{{asset('frontend/img/logo.png')}}" alt="Bl Media"/>
                    </figure>
                    <div class="brand-info">
                        <h2 class="brand-name">In Association with BL Media Inc.</h2>
                        <p> Copyright &copy; <?php echo date('Y'); ?>, www.breaknlinks.com </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 pt-3 footerButtom">
              <span> {{setting('organization_name')}}</span>
                <br>
               <span> {{trans('messages.email')}} : {{setting('organization_email')}} </span>
            </div>
        </div>

    </div>
</footer>--}}
<footer class="mainfooter" role="contentinfo">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="footer-pad">
                    <a href="{{route($routePrefix.'index')}}">
                        <picture class="brand-logo ">
                            <img class=" " src="{{asset('frontend/img/logo.png')}}" height="50" width="100"
                                 alt="BL Media">
                        </picture>
                    </a><br>
                    <ul class="list-unstyled ">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                    <ul class="social-network social-circle ">
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="icoInstagram" title="Twitter"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" class="icoYoutube" title="Twitter"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <!--Column1-->
                    <div class="footer-pad">
                        <h4>Heading 1</h4>
                        <ul class="list-unstyled">
                            <li><a href="#"></a></li>
                            <li><a href="#">Payment Center</a></li>
                            <li><a href="#">Contact Directory</a></li>
                            <li><a href="#">Forms</a></li>
                            <li><a href="#">News and Updates</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="footer-pad">
                        <h4>Heading 2</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Website Tutorial</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Disclaimer</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Webmaster</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <!--Column1-->
                    <div class="footer-pad ">
                        <h4>Editions</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">नेपाली</a></li>
                            <li><a href="#">English</a></li>
                            <li><a href="#">Hindi</a></li>
                            <li><a href="#">Español</a></li>
                            <li><a href="#">عربي</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 copy">
                    <p class="text-center">&copy; Copyright 2020 - BLMedia.  All rights reserved.</p>
                </div>
            </div>


        </div>
    </div>
</footer>
<!--ended page footer-->

