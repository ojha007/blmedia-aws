@extends($module.'::layouts.master')
@section('header')
    Advertisements
@stop
@section('subHeader')
    Create  Advertisements
@stop
@section('breadcrumb')
    {{--        {{ Breadcrumbs::render('news.create',$routePrefix) }}--}}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        <div class="col-md-12">
            {!! Form::model( new \Modules\Backend\Entities\Advertisement(),['route'=> $routePrefix.'advertisements.store',
                        'method'=>'POST','class'=>'','file'=>true,'enctype' => 'multipart/form-data'] ) !!}
            @include($module.'::advertisement.partials.form')
            {!! Form::close() !!}
        </div>

    </div>
@endsection
