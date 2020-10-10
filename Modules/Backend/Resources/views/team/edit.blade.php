@extends($module.'::layouts.master')
@section('header')
    Team
@stop
@section('subHeader')
    Edit  Team
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('team.edit',$team,$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        {!! Form::model($team,['route'=> [$routePrefix.'team.update',$team->id],
            'method'=>'PATCH','file'=>true,'enctype' => 'multipart/form-data'] ) !!}
        @include($module.'::team.partials.form')
        {!! Form::close() !!}

    </div>
@endsection
