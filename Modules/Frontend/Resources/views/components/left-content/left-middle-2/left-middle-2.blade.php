@if(count($sixthPositionNews))
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'above',
                        'sub_for'=>$sixthPositionNews->first()->category_slug])
    @if($sixthPositionNews->first()->is_video)
        <div class="section-row pt-0 front_body_position_4">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left ">
                <div class="row">
                    <div class="col-md-12">
                        @include('frontend::components.news.category-heading',['allNews'=>$sixthPositionNews])
                    </div>
                    @include('frontend::components.videos.card2',['allNews'=>$sixthPositionNews])
                    <div class="col-md-12">
                        @include('frontend::components.buttons.view-all-category-button', ['position' => $sixthPositionNews])
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="newsBlock front_body_position_6 type-5" style="padding: 0 15px;">
            @include('frontend::components.news.category-heading',['allNews'=>$sixthPositionNews])
            <div class="block-body">
                <div class="row d-block">
                    @foreach($sixthPositionNews as $key=>$news)
                        @if($key == 0)
                            <div class="card">
                                <div class="row no-gutters " style="padding: 0 15px;">
                                    <div class="col-md-4">
                                        @include('frontend::components.news.news-image',['imgClass' =>'card-img'] )
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body pt-0 pr-0">
                                            <a href="{{route($routePrefix.'news.show',$news->news_slug)}}"><h5
                                                    class="card-title custom-card-title">
                                                    {{$news->title}}
                                                </h5></a>
                                            @include('frontend::components.news.news-author')
                                            <p class="card-text">{!! $news->short_description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="news-item highlight-news">
                                <div class="featured-img-fixed-height">
                                    @include('frontend::components.news.news-image')
                                </div>
                                <div class="news-content" style="height: auto;">
                                    <h5 class="news-title-am">
                                        <a
                                            href="{{route($routePrefix.'news.show',$news->news_slug)}}">
                                            {{$news->title}}
                                        </a></h5>
                                    @include('frontend::components.news.news-author')
                                    <p class="short-news">
                                        {!! $news->short_description !!}
                                    </p>
                                </div>
                            </div>--}}
                        @elseif($key <=3)
                            <div class="news-item ">
                                <div class="fixed-height-img">
                                    @include('frontend::components.news.news-image')
                                </div>
                                <div class="news-content">
                                    @include('frontend::components.news.news-content')
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @include('frontend::components.buttons.view-all-category-button', ['position' => $sixthPositionNews])
        </div>

    @endif
    @include('frontend::components.ads.ads-2',['ads'=>$allAds,'placement'=>'below',
                       'sub_for'=>$sixthPositionNews->first()->category_slug])
@endif



