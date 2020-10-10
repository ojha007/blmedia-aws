@extends($module.'::layouts.master')
@section('header')
    News
@stop
@section('subHeader')
    List of News
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('news.index',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default ">
                <div class="box-header with-border">
                    <h3 class="box-title">Customize Search</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa @if(request()->has('is_anchor')) fa-plus @else  fa-minus @endif"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(array('route'=>[$routePrefix.'news.index'],'method'=>'GET')) !!}

                    <div class="row">
                        @include('backend::partials.filter',['filterBy'=>[
                                  'is_anchor'=>[
                                      '1'=>'True',
                                      '0'=>'False',
                                         ],
                                  'is_special'=>[
                                       '1'=>'True',
                                      '0'=>'False',
                                     ],
                                     'category'=>$selectCategories,
                                     'guest'=>$selectGuests,
                                     'reporter'=>$selectReporters,
                                 ]])
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-primary">
                            <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter News
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @can('news-create')
                <div class="box-header">
                    <a class="btn btn-primary pull-right btn-flat"
                       href="{{route($routePrefix.'news.create')}}">
                        <i class="fa fa-plus"></i>
                        Add News
                    </a>
                </div>
            @endcan
            <div class="box">
                <div class="box-header">
                    <div class="col-md-12">
                        <div class="col-md-3 pull-right pb-2">
                            {!! Form::open(['route'=> $routePrefix.'news.index','method'=>'GET'] ) !!}
                            <input class="form-control" type="text"
                                   name="q"
                                   value="{{request()->get('q')}}"
                                   placeholder="Search topics or keywords">
                            {{Form::close()}}
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive">

                    <table id="" class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th class="w-25">News</th>
                            <th>Categories</th>
                            <th>Tags</th>
                            <th>Author</th>
                            <th>Publish Date</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allNews as $news)
                            <tr>
                                <td>
                                    {{$news->id}}
                                </td>
                                <td>

                                    <a href="{{route($routePrefix.'news.show',[$news->id])}}">
                                        {{$news->title}}
                                    </a>
                                    <ul>
                                        @isset($news->guest)
                                            <li>
                                                Guest :
                                                <span class="label label-info">
                                              {{$news->guest->name}}
                                         </span>
                                            </li>
                                        @endisset
                                        @isset($news->reporter)
                                            <li>
                                                Reporter :
                                                <span class="label label-success">
                                                    {{$news->reporter->name}}
                                                </span>
                                            </li>
                                        @endisset

                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($news->categories as $category)
                                            <li>
                                                {{$category->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @foreach($news->tags as $tag)
                                        #{{$tag->name}}
                                        @if(!$loop->last),@endif
                                    @endforeach
                                </td>
                                <td>
                                    @isset($news->createdBy)
                                        Created By:
                                        <span class="label label-warning">
                                                    {{$news->createdBy->user_name}}
                                                </span>
                                    @endisset
                                    @isset($news->updatedBy)
                                        <br>
                                        Updated By:
                                        <span class="label label-warning">
                                                    {{$news->updatedBy->user_name}}
                                                </span>
                                    @endisset

                                </td>
                                <td>
                                    {{$news->publish_date}}
                                </td>
                                <td>
                                    {!! spanByStatus($news->is_active,'') !!}
                                </td>
                                <td>
                                    <nobr>
                                        @can('news-edit')
                                            <a href="{{route($routePrefix.'news.edit',$news->id)}}"
                                               class="btn btn-primary btn-sm btn-flat">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('news-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => [$routePrefix.'news.destroy', $news->id],
                                                    'onsubmit' => "return confirm('Are you sure you want to delete?')",   'style'=>"display:inline"
                                              ])!!}
                                            <button class="btn btn-danger btn-flat btn-sm" role="button" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    </nobr>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$allNews->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
@push('scripts')
@endpush
