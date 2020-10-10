@extends($module.'::layouts.master')
@section('header')
    Teams
@stop
@section('subHeader')
    List of Teams
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('team.index',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-header">
                <a class="btn btn-primary pull-right btn-flat"
                   href="{{route($routePrefix.'team.create')}}">
                    <i class="fa fa-plus"></i>
                    Add Teams
                </a>
            </div>
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="dataTable" class="table table-bordered table-condensed dataTable">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Designation</th>
                            <th width="20%">Image</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td>
                                    {{$team->id}}
                                </td>
                                <td>
                                    {!! $team->title !!}
                                </td>
                                <td>
                                    {!! $team->detail !!}
                                </td>
                                <td>
                                    {{$team->designation}}
                                </td>
                                <td>
                                </td>
                                <td>
                                    {{$team->email}}
                                </td>
                                <td>{!! spanByStatus($team->is_active) !!}</td>
                                <td>
                                    <a href="{{route($routePrefix.'team.edit',$team->id)}}"
                                       class="btn btn-primary btn-sm btn-flat">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => [$routePrefix.'team.destroy', $team->id],
                                            'onsubmit' => "return confirm('Are you sure you want to delete?')",   'style'=>"display:inline"
                                      ])!!}
                                    <button class="btn btn-danger btn-flat btn-sm" role="button" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
@push('scripts')
@endpush
