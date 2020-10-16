@include('frontend::components.news.news-template',['allNews'=>$trendingNews,
                'class' => 'front_body_position_7',

])
@if(request()->segment(1) == 'nepali')
    @include('frontend::components.news.news-template',['allNews'=>$seventhPositionNews,
                    'class' => 'front_body_position_7',
                    'image'=>'reporter_image',
    ])
@else
    @include('frontend::components.news.news-template',['allNews'=>$seventhPositionNews,
                   'class' => 'front_body_position_7',

   ])
@endif
