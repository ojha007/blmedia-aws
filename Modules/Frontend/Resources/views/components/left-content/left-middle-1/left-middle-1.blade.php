@if(count($fourthPositionNews))
    @if($fourthPositionNews->first()->is_video)
       {{-- <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$allNews])
            <div class="card-body text-primary">
                @foreach($allNews as $news)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                --}}{{--                        @include('frontend::components.news.news-image',['image'=>'reporter_image','figureClass'=>'','imgClass'=>'card-img'])--}}{{--
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    @include('frontend::components.news.news-title')
                                    @include('frontend::components.news.news-author')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>--}}
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
@endif
{{--@push('scripts')

@endpush--}}

