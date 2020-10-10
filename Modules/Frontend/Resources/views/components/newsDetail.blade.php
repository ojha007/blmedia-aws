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
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-6">
                                    <div class="post-info">
                                            <span>
                                                 <img
                                                     src="{{$news->reporter->image ?? asset('/frontend/images/logo.png')}}"
                                                     alt="{{$news->image_alt}}"
                                                     title="{{$news->sub_description}}"
                                                     class="responsive-img">
                                            </span>
                                        <p>
                                            @if($news->reporter || $news->guest)
                                                @php($author_type = $news->reporter ? 'reporters' : 'guests')
                                                @php($author_slug = $news->reporter ? $news->reporter->slug : $news->guest->slug)
                                                <a href="{{route($routePrefix.'news.by.author',[$author_type,$author_slug])}}"
                                                   class="highlight">
                                                <span class="usr">
                                                    {{ $news->reporter ? $news->reporter->name
                                                     :( $news->guest ? $news->guest->name:'')  }}
                                                    </span>
                                                </a>
                                            @endif

                                        </p>
                                        <ul class="post-info-details">
                                            <li>
                                                <p>
                                                    <i class="fa fa-clock"></i> {{ Carbon\Carbon::parse($news->publish_date)->format('Y-m-d') }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-8 col-lg-6">
                                    <div class="sharethis-inline-share-buttons"></div>
{{--                                    <div class="addthis_inline_share_toolbox"--}}
{{--                                         data-url="{{route($routePrefix.'news.show',$news->id)}}"--}}
{{--                                         data-title="{{$news->title}}"--}}
{{--                                         data-description="{{$news->title}}"--}}
{{--                                         data-media="{{$news->image}}"--}}
{{--                                    ></div>--}}

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                </div>
                            </div>
                        </div>
                        @if($news->video_url)
                            <div class="video-section">
                                {!! $news->video_url !!}
                            </div>
                        @else
                            <div class="news-banner">
                                @include('frontend::components.news.news-image',['figureClass'=>'bannerImg'])

                            </div>
                        @endif
                        <div class="news-story">
                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 offset-lg-1">
                                {!! $news->description !!}
                                <div class="col-sm-6 col-xs-12">
                                    <strong> {{trans('messages.publish_on')}}
                                        : {{\Carbon\Carbon::parse($news->publish_date)->toDateTimeString()}}</strong>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="adsssss amadam">
                                        <div class="sharethis-inline-share-buttons"></div>
{{--                                        <div class="addthis_inline_share_toolbox"--}}
{{--                                             data-url="{{route($routePrefix.'news.show',$news->id)}}"--}}
{{--                                             data-title="{{$news->title}}"--}}
{{--                                             data-description="{{$news->title}}"--}}
{{--                                             data-media="{{$news->image}}"--}}
{{--                                        ></div>--}}
                                    </div>
                                </div>


                            </div>


                        </div>

                    </div>
                    <div class="section-row">
                        <div class="col-sm-12  py-3 offset-lg-1">

                            @foreach($news->tags as $tags)
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
                            {{--                                <div class="fb-comments"--}}
                            {{--                                     data-href="https://developers.facebook.com/docs/plugins/comments#configurator"--}}
                            {{--                                     data-numposts="5" data-width=""></div>--}}
                            <!--if user is not logged then this block shold be display-->
                                <div class="commentLogin">
                                    {{--<div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop"
                                         data-href="https://www.breaknlinks.com/hindi/news/1939" data-width="100%"
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
                                                style="border: none; visibility: visible; width: 0px; height: 0px;"
                                                __idm_frm__="164"></iframe></span></div>--}}

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
                                  'class'=>' blspecial-body bisheshNew'

                                  ])
                    @include('frontend::components.news.news-template',['allNews'=>$detailPageSecondPositionNews])
                    @include('frontend::components.news.news-template',['allNews'=>$detailPageThirdPositionNews])
                </div>
                <!--ended right panel section-->
            </section>
            <div class="clearfix"></div>
        </div>
    </section>
@endsection
{{--<div class="addthis_inline_share_toolbox"--}}
{{--     data-url="{{route($routePrefix.'news.show',$news->id)}}"--}}
{{--     data-title="{{$news->title}}"--}}
{{--     data-description="{{$news->title}}"--}}
{{--     data-media="{{$news->image}}"--}}
{{--></div>--}}
@push('meta')
{{--    <meta property="fb:app_id" content="1234567890"/>--}}
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{route($routePrefix.'news.show',$news->id)}}"/>
    <meta property="og:title" content="{{$news->title}}"/>
    <meta property="og:image"
          content="{{$news->image}}"/>
    <meta property="og:description" content="{{$news->short_description}}"/>
@endpush
