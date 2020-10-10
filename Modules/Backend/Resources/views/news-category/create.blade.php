@extends($module.'::layouts.master')
@section('header')
    News Category
@stop
@section('subHeader')
    Create  News category
@stop
@section('breadcrumb')
        {{ Breadcrumbs::render('news.create',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('route' => $routePrefix.'category.store',
                                       'method'=>'POST','class'=>' tab_form')) !!}
            @include($module.'::news-category.partials.form')
            {{Form::close()}}
        </div>
    </div>


@endsection


