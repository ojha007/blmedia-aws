
@isset($ads_below_recommendation_news)
    <div class="container-fluid text-center">
        @include('frontend::components.ads.ads-2',['ads'=>$ads_above_recommendation_news])
    </div>

@endisset
<div class="card  border-primary  mb-3 recommendation">
    <div class="card-header custom-heading">
        <p>
            <a href="#">
                {{trans('messages.other_news')}}
            </a>
        </p>
    </div>
    <div class="card-block">
        <div class="row">
            @foreach($sameCategoryNews as $key=>$news)
                <div class="col-sm-12 recommendation-div col-md-6 col-lg-4 col-xl-4">
                    <div class="card mb-3 recommendation-card ">
                        @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img-top'])
                        <div class="card-body">
                            @include('frontend::components.news.news-title')
                            @include('frontend::components.news.news-author')
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{--<div class="section-row">
    <div class="newsBlock type-4 recommendation">
        <div class="block-header gn-heading">
            <h2><a href="#">{{trans('messages.other_news')}}</a></h2>
        </div>
        <div class="block-body">
            <div class="row">
                @foreach($sameCategoryNews as $key=>$news)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 float-left">
                        <div class="news-item recommendation-card">
                            @include('frontend::components.news.news-image' ,['imgClass'=>'card-img-top','figureClass'=>''])
                            <div class="news-content">
                                @include('frontend::components.news.news-content')
                                @include('frontend::components.news.news-author')
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>--}}
@isset($ads_below_recommendation_news)
    <div class="container-fluid text-center">
        @include('frontend::components.ads.ads-2',['ads'=>$ads_below_recommendation_news])
    </div>

@endisset
