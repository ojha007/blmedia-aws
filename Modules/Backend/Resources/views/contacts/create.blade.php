@extends($module.'::layouts.master')
@section('header')
    {{$type}}
@stop
@section('subHeader')
    Create  {{$type}}
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render(strtolower($type).'.create',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        {!! Form::open(['route'=> $routePrefix.strtolower($type).'.store',
            'method'=>'POST','class'=>'','file'=>true, "enctype"=>"multipart/form-data"] ) !!}
        @include($module.'::contacts.partials.form')
        {!! Form::close() !!}

    </div>
@endsection
