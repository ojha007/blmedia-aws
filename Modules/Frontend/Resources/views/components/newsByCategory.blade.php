@extends('frontend::layouts.master')
@section('content')
    @include('frontend::components.breadcrumb')
    <section class="body-section">
        <section class="page-body">
            <div class="container-fluid">
                @if(count($newsByCategory))
                    @include('frontend::components.ads.ads-2',[
                                        'ads'=>$allAds,'placement'=>'above',
                                        'sub_for'=>$newsByCategory->first()->category_slug
                                            ])
                @endif

                <section class="cmn-section">
                    <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 float-left ">
                        @include('frontend::components.news.category-heading',['allNews'=>$newsByCategory])
                        @if(count($childCategoriesNews))
                            @include('frontend::components.withChildCategory')
                        @else
                            @if(count($newsByCategory))
                                @include('frontend::components.no-childCategory')
                            @endif
                        @endif
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 float-right">
                        @include('frontend::components.news.news-template',
                            [
                                'allNews'=>$blSpecialNews,
                                'bodyClass'=>'blspecial-body bisheshNew'

                                ])
                        @include('frontend::components.news.news-template',['allNews'=>$detailPageSecondPositionNews])
                        @include('frontend::components.news.news-template',['allNews'=>$detailPageThirdPositionNews,'image'=>'reporter_image'])
                    </div>
                </section>
                @if(count($newsByCategory))
                    @include('frontend::components.ads.ads-2',[
                                       'ads'=>$allAds,'placement'=>'below',
                                       'sub_for'=>$newsByCategory->first()->category_slug
                                           ])
                @endif
            </div>
        </section>
    </section>
@endsection
