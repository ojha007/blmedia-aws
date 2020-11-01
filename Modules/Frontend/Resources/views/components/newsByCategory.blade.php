@extends('frontend::layouts.master')
@section('content')
    @include('frontend::components.breadcrumb')
    <div class="offset-lg-1 col-lg-10">
        <div class="row ">
            <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 sm-mb-3 left-content ">
                <div class="card border-primary mb-3 news-by-category">
                    <div class="card-block">
                        @if(count($childCategoriesNews))
                            @include('frontend::components.withChildCategory')
                        @else
                            @if(count($newsByCategory))
                                @include('frontend::components.no-childCategory')
                            @endif
                        @endif
                    </div>
                </div>
                {{--<div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
                    @include('frontend::components.card-header',['header'=>$newsByCategory])
                    <div class="card-body ">
                        @if(count($childCategoriesNews))
                            @include('frontend::components.withChildCategory')
                        @else
                            @if(count($newsByCategory))
                                @include('frontend::components.no-childCategory')
                            @endif
                        @endif
--}}{{--                        @include('frontend::components.buttons.view-all-category-button', ['position' => $newsByCategory])--}}{{--
                    </div>
                </div>--}}
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 right-content">
                @include('frontend::components.news.news-template',
                          [
                              'allNews'=>$blSpecialNews,
                             'positionClass'=>'detail_body_position_1',
                              'blSpecialBackgroundClass'=>'bl-special-background-color'
                              ])
                @include('frontend::components.news.news-template3',['allNews'=>$detailPageSecondPositionNews,  'positionClass'=>'detail_body_position_2'])
                @include('frontend::components.news.news-template2',['allNews'=>$detailPageThirdPositionNews,  'positionClass'=>'detail_body_position_3'])
            </div>
        </div>
    </div>
    {{--   <div class="container-fluid">
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
                                   'positionClass'=>'detail_body_position_1'
                                    ])
                   @include('frontend::components.news.news-template',['allNews'=>$detailPageSecondPositionNews,  'positionClass'=>'detail_body_position_2'])
                   @include('frontend::components.news.news-template',['allNews'=>$detailPageThirdPositionNews,  'positionClass'=>'detail_body_position_3'])
               </div>
           </section>
           @if(count($newsByCategory))
               @include('frontend::components.ads.ads-2',[
                                  'ads'=>$allAds,'placement'=>'below',
                                  'sub_for'=>$newsByCategory->first()->category_slug
                                      ])
           @endif
       </div>--}}
@endsection
