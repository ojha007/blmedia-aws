@if(count($fifthPositionNews))
    @include('frontend::components.news.news-template2',[
    'allNews'=>$fifthPositionNews,
'positionClass'=>'front_body_position_5'
    ])
@endif
