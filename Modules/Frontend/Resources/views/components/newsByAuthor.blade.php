@extends('frontend::layouts.master')
@section('content')
    <section class="body-section">
        <section class="page-body">
            <div class="container-fluid">
                <section class="cmn-section">
                    @isset($newsByAuthor)
                        @if(count($newsByAuthor))
                            <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 float-left">
                                <div class="block-header gn-heading">
                                    @if($newsByAuthor->first()->reporter_name )
                                        <h2>
                                            {{$newsByAuthor->first()->reporter_name}}
                                        </h2>
                                    @elseif($newsByAuthor->first()->guest_name)
                                        <h2>
                                            {{$newsByAuthor->first()->guest_name}}
                                        </h2>
                                    @endif
                                </div>
                                @include('frontend::components.no-childCategory',['newsByCategory'=>$newsByAuthor])

                            </div>
                        @endif
                    @endif
                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 float-right">
                        @include('frontend::components.news.news-template',
                                  [
                                      'allNews'=>$blSpecialNews,
                                      'class'=>' blspecial-body bisheshNew'

                                      ])
                        @include('frontend::components.news.news-template',['allNews'=>$trendingNews, 'class' => 'front_body_position_7',])
                        @include('frontend::components.news.news-template',['allNews'=>$detailPageSecondPositionNews,'image'=>'reporter_image'])
                        @include('frontend::components.news.news-template',['allNews'=>$detailPageThirdPositionNews])
                    </div>
                </section>
            </div>
        </section>
    </section>
@endsection
