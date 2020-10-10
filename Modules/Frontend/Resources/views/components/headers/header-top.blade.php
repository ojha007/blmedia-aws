<div class="container-fluid text-center px-0 header-top-ads">
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above','sub_for'=>'top_menu'])
</div>
<section class="header-top">
    <div class="container-fluid ">
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 float-left scroll-news">
            <div class="scroll-header">
                <h4>{{trans('messages.editions')}}</h4>
            </div>
            <div class="scroll-news-content">
                <div class="tickercontainer">
                    <div class="mask">
                        <ul id="scrollNewsList" class="newsTickerLisst newsticker"
                            style="width: 3454px; left: -2434.21px;">
                            <li>
                                <a href="{{url('/nepali')}}" class="am-bl-topscroll active"
                                   target="_blank">नेपाली</a>
                            </li>
                            <li>
                                <a href="{{url('/en')}}" class="am-bl-topscroll active"
                                   target="_blank">English</a>
                            </li>
                            <li>
                                <a href="{{url('/hindi')}}" class="am-bl-topscroll active"
                                   target="_blank">Hindi</a>
                            </li>
                            <li>
                                <a href="#" class="am-bl-topscroll active"
                                >Español</a>
                            </li>
                            <li>
                                <a href="#" class="am-bl-topscroll active"
                                >عربي</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 float-right ">
            <span class="overflow-hidden  float-right">
                <button class="btn btn-outline-light border-0 rounded-0 search-button" type="button"
                        data-toggle="collapse"
                        data-target="#searchDropdown" aria-expanded="false" aria-controls="searchDropdown">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        <div class="clearfix"></div>
    </div>
</section>

<div class="collapse container-fluid" id="searchDropdown">
    <div class="card card-body border-0 rounded-0 searchBody ">
        <form>
            <div class="form-row">
                <div class="col-3">
                    <input type="text" class="form-control datepicker" name="from"
                           autocomplete="off"
                           placeholder="From"/>

                </div>
                <div class="col-3">

                    <input type="text" class="form-control datepicker" autocomplete="off"
                           name="to" placeholder="To"/>

                </div>
                <div class="col-4">
                    <input type="text" class="form-control " name="q"
                           autocomplete="off"
                           placeholder="{{trans('messages.search')}}">
                </div>
                <div class="col-2">
                    <button class="btn bg-secondary btn-block btn-sm text-white"><i class="fa fa-search "></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.search-button').on("click", function () {
                $('i', this).toggleClass("fa fa-search fas fa-times");
            });
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                inline: true,
                sideBySide: true,
                todayHighlight: true,
                orientation: "bottom auto",
                autoclose: true
            });


        });
    </script>
@endpush
