@if(count($fourthPositionNews))
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                          'sub_for'=>$fourthPositionNews->first()->category_slug])
    @if($fourthPositionNews->first()->is_video)
        <div class="section-row pt-0 front_body_position_4">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left ">
                <div class="row">
                    <div class="col-md-12">
                        @include('frontend::components.news.category-heading',['allNews'=>$fourthPositionNews])
                    </div>
                    @include('frontend::components.videos.card2')
                    <div class="col-md-12">
                        @include('frontend::components.buttons.view-all-category-button', ['position' => $fourthPositionNews])
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('frontend::components.left-content.left-middle-5.left-middle-5',['twelvePositionNews'=>$fourthPositionNews])
    @endif
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                          'sub_for'=>$fourthPositionNews->first()->category_slug])
@endif
@push('scripts')

@endpush

