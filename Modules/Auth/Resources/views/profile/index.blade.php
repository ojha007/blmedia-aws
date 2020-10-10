@extends('backend::layouts.master')

@section('header')
    <i class="fa fa-fw fa-user">

    </i> {{ $user->user_name }}
@endsection

@section('subHeader')
    Edit your profile
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('profile',$routePrefix) }}
@stop
@section('content')
    @include('backend::partials.errors')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle"
                         id="holder"
                         src="{{asset('/images/default.jpg')}}"
                         alt="user image"
                    >

                    <h3 class="profile-username text-center">{{ $user->user_name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>

                    {!! Form::model($user, ['method' => 'POST', 'enctype'=>'multipart/form-data',
                            'class'=>'form-horizontal','route' => [$routePrefix.'profile.avatar']]) !!}
                    <div class="col-md-12">
                        @include('backend::partials.choose-image',['name'=>'avatar','label'=>'Image'])
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat btn-block">Change Profile Picture</button>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom" id="myTab">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
                    <li><a href="#change-password" data-toggle="tab" aria-expanded="false">Change Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        {!! Form::model($user, ['method' => 'PATCH', 'class'=>'form-horizontal','route' => [$routePrefix.'profile.update', $user->id]]) !!}
                        <div class="form-group {{ $errors->has('user_name') ? 'has-error':'' }}">
                            {{ Form::label('name', 'User name', ['class'=>'col-sm-2 control-label'])}}
                            <div class="col-sm-6">
                                {!! Form::text('user_name', null, array('placeholder' => 'User Name','class' => 'form-control')) !!}
                                {!! $errors->first('user_name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
                            {{ Form::label('email', 'Email', ['class'=>'col-sm-2 control-label'])}}
                            <div class="col-sm-6">
                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn  btn-flat btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="change-password">
                        {!! Form::open(array('method' => 'POST', 'class'=>'form-horizontal','route' => [$routePrefix.'changePassword'])) !!}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            {{ Form::label('current-password', 'Current Password', ['class'=>'col-sm-2 control-label'])}}
                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control"
                                       name="current-password" placeholder="Current Password">
                                {!! $errors->first('current-password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            {{ Form::label('new-password', 'New Password', ['class'=>'col-sm-2 control-label'])}}
                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password"
                                       placeholder="New Password">
                                {!! $errors->first('new-password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('new-password-confirm', 'Confirm New Password', ['class'=>'col-sm-2 control-label'])}}
                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control"
                                       name="new-password_confirmation" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@push('scripts')
    <script>
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
    </script>
@endpush
