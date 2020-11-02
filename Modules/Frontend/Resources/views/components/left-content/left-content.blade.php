
<section class="below-header-section">
    @include('frontend::components.left-content.below-header.below-header')
</section>
<section class="ads-1-section">
    @include('frontend::components.ads.ads-1')
</section>
<section class="left-middle-1-section">
    @include('frontend::components.left-content.left-middle-1.left-middle-1', [ 'positionClass'=>'front_body_position_4 '])
</section>
<section class="left-middle-2-section">
    @include('frontend::components.left-content.left-middle-2.left-middle-2', [ 'positionClass'=>'front_body_position_6'])
</section>
<section class="left-middle-3-section">
    @include('frontend::components.left-content.left-middle-3.left-middle-3',['baseAllNews'=>$eighthPositionNews, 'positionClass'=>'front_body_position_8'])
</section>
<section class="left-middle-4-section">
    @include('frontend::components.left-content.left-middle-4.left-middle-4', [ 'positionClass'=>'front_body_position_10'])
</section>
<section class="ads-2-section">
    @include('frontend::components.ads.ads-2')
</section>
<section class="left-middle-5-section">
    @include('frontend::components.left-content.left-middle-5.left-middle-5', [ 'positionClass'=>'front_body_position_12'])
</section>
<section class="left-middle-6-section">
    @include('frontend::components.left-content.left-middle-6.left-middle-6', [ 'positionClass'=>'front_body_position_12'])
</section>
<section class="left-middle-3-section">
    @include('frontend::components.left-content.left-middle-3.left-middle-3',['baseAllNews'=>$fifteenPositionNews, 'positionClass'=>'front_body_position_8'])
</section>
<section class="above-footer-section">
    @include('frontend::components.left-content.above-footer.above-footer', [ 'positionClass'=>'front_body_position_13'])
</section>


