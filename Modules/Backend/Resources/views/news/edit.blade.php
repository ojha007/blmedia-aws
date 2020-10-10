@extends($module.'::layouts.master')
@section('header')
    News
@stop
@section('subHeader')
    Edit  News
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('news.edit',$news,$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        {!! Form::model($news,['route'=> [$routePrefix.'news.update',$news->id],
            'method'=>'PATCH'] ) !!}
        @include($module.'::news.partials.form')
        {!! Form::close() !!}

    </div>
@endsection
