@extends('frontend::layouts.master')
@section('content')
    <section class="page-body">
        <div class="container-fluid">
            <section class="cmn-section">
                <!--section news details-->
                <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 float-left">
                    <div class="news-details">
                        <div class="details-header">
                            <h2 class="news-title">{!! $news->title !!}</h2>
                            <p class="subtitles">
                                {!! $news->sub_title !!}
                            </p>
                            <div class="row ">
                                @if($news->reporter_name)
                                    <div class="col-6 col-md-6 col-lg-6 ">
                                        <div class="circular--portrait">
                                            <img
                                                src="{{ ($news->reporter_image ? $news->reporter_image: asset('/frontend/img/logo.png'))}}"
                                                alt="{{$news->image_alt}}"
                                                title="{{$news->sub_description}}"
                                                class="responsive-img">

                                        </div>
                                        @if($news->reporter_slug)
                                            <a href="{{route($routePrefix.'news.by.author',
                                                ['reporter',$news->reporter_slug])}}">
                                                <i class="fa fa-user blus"></i>
                                                {{$news->reporter_name}}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                @if($news->guest_name)
                                    <div class="col-6 col-md-6 col-lg-6 ">
                                        <div class="circular--portrait">
                                            <img
                                                src="{{$news->guest_image ?$news->guest_image:
                                                  asset('/frontend/img/logo.png')}}"
                                                alt="{{$news->image_alt}}"
                                                title="{{$news->sub_description}}"
                                                class="responsive-img">
                                        </div>
                                        @if($news->guest_slug)
                                            <a href="{{route($routePrefix.'news.by.author',
                                           ['guests',$news->guest_slug])}}">
                                                <i class="fa fa-user blus"></i>
                                                {{$news->guest_name}}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-md-4 text-left float-left">
                                        @if($news->date_line)
                                            <i class="fa fa-map-marker blus"></i>
                                            {{$news->date_line}}
                                        @endif
                                    </div>
                                    <div class="col-md-8 float-right">
                                        <div class="sharethis-inline-share-buttons"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                </div>
                            </div>
                        </div>
                        @if($news->video_url)
                            <div class="video-section user_detail_image">
                                {!! $news->video_url !!}
                            </div>
                        @else
                            <div class="news-banner user_detail_image">
                                @include('frontend::components.news.news-image',['figureClass'=>'bannerImg'])
                                @if($news->image_description)
                                    <p class="float-right">
                                        {{$news->image_description}}
                                    </p>
                                @elseif($news->image_alt)
                                    <p class="float-right">
                                        {{$news->image_alt}}
                                    </p>
                                @endif
                            </div>
                        @endif
                        <div class="news-story">
                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 offset-lg-1">
                                {!! $news->description !!}
                                @if($news->external_url)
                                    <div class="col-md-12 text-center align-center">
                                        <a href="{{$news->external_url}}"
                                           target="_blank"
                                           class=" btn btn-viewAll text-center align-center"
                                           role="button">{{trans('messages.read_all')}}
                                        </a>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <strong> {{trans('messages.publish_on')}}
                                        : {{\Carbon\Carbon::parse($news->publish_date)->toDateTimeString()}}</strong>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="sharethis-inline-share-buttons"></div>

                                </div>


                            </div>


                        </div>

                    </div>
                    <div class="section-row">
                        <div class="col-sm-12  py-3 offset-lg-1">

                            @foreach($news_tags as $tags)
                                <span class=" custom-tag">{{$tags->name}}</span>
                            @endforeach
                        </div>
                    </div>

                    {{--                    @include('frontend::components.tags-news')--}}
                    <div class="cmn-fw">
                        <div class="hr-c">
                            <div class="ggl_adBlk _930x180">
                            </div>
                        </div>
                    </div>
                    <!--ended horizontal wide banner ad-->
                    {{--                    <div class="section-row">--}}
                    {{--                        <div class="newsBlock type-4 recommendation">--}}
                    {{--                            <div class="block-header gn-heading">--}}
                    {{--                                <h2><a href="#">{{trans('messages.other_news')}}</a></h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="block-body">--}}
                    {{--                                <div class="row">--}}
                    {{--                                    @foreach($sameCategoryNews->take(3) as $key=>$news)--}}
                    {{--                                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 float-left">--}}
                    {{--                                            <div class="news-item recommendation-card">--}}
                    {{--                                                @include('frontend::components.news.news-image' ,['imgClass'=>'card-img-top','figureClass'=>''])--}}
                    {{--                                                <div class="news-content">--}}
                    {{--                                                    @include('frontend::components.news.news-content')--}}
                    {{--                                                    @include('frontend::components.news.news-author')--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="section-row">
                        <div class="commentReview">
                            <div class="block-header">
                                <h2>{{trans('messages.write_your_comment')}}</h2>
                            </div>
                            <div class="block-body">
                                <div class="commentLogin">
                                    <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop"
                                         data-href="{{route($routePrefix.'news.show',$news->news_slug)}}"
                                         data-width="100%"
                                         data-numposts="5" fb-xfbml-state="rendered"
                                         fb-iframe-plugin-query="app_id=264188744527053&amp;container_width=912&amp;height=100&amp;href=https%3A%2F%2Fwww.breaknlinks.com%2Fhindi%2Fnews%2F1939&amp;locale=en_US&amp;numposts=5&amp;sdk=joey&amp;version=v4.0&amp;width="
                                         style="width: 100%;"><span
                                            style="vertical-align: top; width: 100%; height: 0px; overflow: hidden;"><iframe
                                                name="f10491cb376b48" width="1000px" height="100px"
                                                data-testid="fb:comments Facebook Social Plugin"
                                                title="fb:comments Facebook Social Plugin" frameborder="0"
                                                allowtransparency="true" allowfullscreen="true" scrolling="no"
                                                allow="encrypted-media"
                                                src="https://www.facebook.com/v4.0/plugins/comments.php?app_id=264188744527053&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df202fa61db2be6c%26domain%3Dwww.breaknlinks.com%26origin%3Dhttps%253A%252F%252Fwww.breaknlinks.com%252Ff29dde41e6a9a1%26relation%3Dparent.parent&amp;container_width=912&amp;height=100&amp;href=https%3A%2F%2Fwww.breaknlinks.com%2Fhindi%2Fnews%2F1939&amp;locale=en_US&amp;numposts=5&amp;sdk=joey&amp;version=v4.0&amp;width="
                                                __idm_frm__="164"></iframe></span></div>

                                </div>
                                <!--ended login block-->
                            </div>
                        </div>
                    </div>
                    @include('frontend::components.recommendation')
                </div>
                <!--ended news details section-->
                <!--right panel section-->
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 float-right">
                    @include('frontend::components.news.news-template',
                              [
                                  'allNews'=>$blSpecialNews,
                                  'bodyClass'=> 'blspecial-body bisheshNew'

                                  ])
                    @include('frontend::components.news.news-template',['allNews'=>$detailPageSecondPositionNews,'image'=>'reporter_image'])
                    @include('frontend::components.news.news-template',['allNews'=>$detailPageThirdPositionNews])
                </div>
                <!--ended right panel section-->
            </section>
            <div class="clearfix"></div>
        </div>
    </section>
@endsection
@push('meta')
    {{--    <meta name="{{$news->title}}"--}}
    {{--          content="{{$news->short_description}}"--}}
    {{--          category--}}
    {{--    />--}}
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{route($routePrefix.'news.show',$news->news_slug)}}"/>
    <meta property="og:title" content="{{$news->title}}"/>
    <meta property="og:image" content="{{$news->image}}"/>
    <meta property="og:description" content="{{$news->short_description}}"/>
    {{--    <meta name="twitter:card" content="summary_large_image"/>--}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{route($routePrefix.'news.show',$news->news_slug)}}"/>
    <meta name="twitter:title" content="{{$news->title}}"/>
    <meta name="twitter:image:src" content="{{$news->image}}"/>
    <meta name="twitter:description" content="{{$news->short_description}}"/>
@endpush

<style>
    .user_detail_image {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .circular--portrait {
        position: relative;
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 50%;
    }

    .circular--portrait img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /*.user_detail_image:hover {*/
    /*    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);*/
    /*}*/
</style>
