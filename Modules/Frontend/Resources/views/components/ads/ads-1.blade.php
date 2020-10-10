@isset($ads)
    @if(count($ads)>0)
        @foreach($ads as $ad)
            <div class="cmn-fw">
                <div class="col-sm-12">
                    <div class="hr-c">
                        <div class="col-12_1230X100">
                            @include('frontend::components.ads.ads-image')
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endisset

