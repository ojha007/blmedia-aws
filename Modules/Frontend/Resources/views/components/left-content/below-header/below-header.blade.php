<div class="section-row pt-0">
    @php
        $subFor =[];
        if(isset($firstPositionNews) && count($firstPositionNews) ){
            array_push($subFor,$firstPositionNews->first()->category_slug);
        }
        if(isset($secondPositionNews) && count($secondPositionNews) ){
            array_push($subFor,$secondPositionNews->first()->category_slug);
        }
    @endphp
    <div class="container-fluid text-center">
        @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                            'sub_for'=>$subFor])
    </div>
    <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 float-left">
        @include('frontend::components.left-content.below-header.left')
    </div>
    <div class="col-sm-12 col-md-7 col-lg-8 col-xl-8 float-right">
        @include('frontend::components.left-content.below-header.middle')
    </div>
    <div class="container-fluid text-center">
        @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                            'sub_for'=>$subFor])
    </div>
</div>
