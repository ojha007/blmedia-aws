<div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    Create Team
                </strong>
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group col-md-6 {{$errors->has('title') ?'has-error':''}}">
                <label class="required" for="title">
                    Title
                </label>
                {{Form::text('title',null,
                    [
                    'class'=>'col-md-6 form-control required valid',
                    'placeholder'=>'Enter Team Title',
                    ])}}
            </div>
            <div class=" form-group   col-md-6 {{$errors->has('designation') ?'has-error':''}}">
                {{Form::label('designation','Designation:')}}
                {{Form::text('designation',null,
                            [
                            'class'=>' form-control',
                            'placeholder'=>'Enter Designation',
                            ])}}
            </div>
            <div class=" form-group  col-md-6 {{$errors->has('email') ?'has-error':''}}">
                {{Form::label('email','Email:')}}
                {{Form::email('email',null,
                            [
                            'class'=>' form-control',
                            'placeholder'=>'Enter Email',
                            ])}}
            </div>
            <div class="form-group col-md-6" style="padding-right: 0">
                <label for="fieldID4">Image</label>
                <div class="input-group">
                   <span class="input-group-btn btn-flat">
                     <a id="banner_image" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                    <label for="image_label">
                    </label>
                    <input type="text" id="image_label" class="form-control" name="image">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;" alt="">
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-11">
                    {{ Form::label('is_active', 'Is Active:')}}
                    {!! Form::hidden('is_active', 0) !!}
                    <div class="row">
                        <input name="is_active" value="1" type="checkbox" class="form-control" data-toggle="toggle"
                               data-on="Active"
                               data-off="Inactive">
                    </div>
                </div>
            </div>
            <div class=" form-group  col-md-12 {{$errors->has('detail') ?'has-error':''}}">
                {{Form::label('detail','Detail:')}}
                {{Form::textarea('detail',null,
                            [
                            'class'=>'col-md-6 form-control ',
                            'placeholder'=>'Enter Details',
                            ])}}
            </div>


        </div>
        <div class="box-footer">
            <a href="{{route($routePrefix.'team.index')}}" type="button" class="btn pull-left btn-flat btn-default">
                <i class="fa fa-arrow-left">
                </i>
                Close
            </a>
            <button type="submit" class="btn btn-primary  pull-right btn-flat">
                <i class="fa fa-save"></i> Submit
            </button>
        </div>

    </div>
</div>


@push('scripts')
    <script>
        CKEDITOR.replace('detail', {filebrowserImageBrowseUrl: '/bl-secure/file-manager/ckeditor'});
    </script>
@endpush
