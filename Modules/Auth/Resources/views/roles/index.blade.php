@extends('backend::layouts.master')
@section('header')
    List Roles
@endsection

@section('subHeader')
    Show the list of all roles
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('roles.index',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-header">
                <a href="{{ route($routePrefix.'roles.create') }}"
                   class="btn btn-primary btn-flat pull-right bootstrap-modal-form-open">
                    <i class="fa fa-plus"> Add Roles</i>
                </a>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="roles-dataTable" class="table table-bordered table-condensed dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="no-sort" style="width: 15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-flat btn-sm" data-container="body"
                                           title="Edit"
                                           href="{{ route($routePrefix.'roles.edit', $role->id) }}"><i
                                                class="fa fa-edit "></i></a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => [$routePrefix.'roles.destroy', $role->id],
                                    'style'=>'display:inline', 'onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-flat btn-sm', "data-container"=>"body",
                                                         "title"=>"Delete" ,'role' => 'button', 'type' => 'submit']) }}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        {{--        <!-- /.col -->--}}
    </div>
@endsection
