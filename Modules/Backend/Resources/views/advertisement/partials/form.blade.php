<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            Create Advertisement
        </h3>
    </div>
    <div class="box-body">
        <div class="form-group col-md-6 {{$errors->has('title')?'has-error':''}}">
            {{ Form::label('title', 'Ads Title:', ['class'=>'control-label required'])}}
            {!! Form::text('title', null, array('placeholder' => 'Enter Title','class' => 'form-control')) !!}

        </div>
        <div class="form-group col-md-6 {{$errors->has('slug')?'has-error':''}}">
            {{ Form::label('url', 'Ads Url:', ['class'=>'control-label required'])}}
            {!! Form::text('url', null, array('placeholder' => 'Enter Ads Url','class' => 'form-control')) !!}

        </div>
        <div class="form-group col-md-6 {{$errors->has('for')?'has-error':''}}">
            {{ Form::label('for', 'Ads For:', ['class'=>'control-label required'])}}
            {!! Form::select('for',$selectAdsFor, null, array('placeholder' => 'Select ads for','class' => 'form-control select2')) !!}

        </div>
        <div class="form-group col-md-6 {{$errors->has('placement')?'has-error':''}}">
            {{ Form::label('placement', 'Placement:', ['class'=>'control-label required'])}}
            {!! Form::select('placement', $placement,null, array('placeholder' => 'Select Placement','class' => 'form-control select2')) !!}

        </div>
        <div class="form-group col-md-6 {{$errors->has('for')?'has-error':''}}">
            {{ Form::label('sub_for', 'Ads Sub For:', ['class'=>'control-label required'])}}
            {!! Form::select('sub_for',$selectAdsSubFor, null, array('placeholder' => 'Select sub for ','class' => 'form-control select2')) !!}

        </div>

        <div class="form-group col-md-6 {{$errors->has('sub_placement')?'has-error':''}}">
            {{ Form::label('sub_placement', 'Ads Sub Placement:', ['class'=>'control-label '])}}
            {!! Form::select('sub_placement', [], null, array('placeholder' => 'Select Sub Placement Code','class' => 'form-control select2')) !!}

        </div>
        <div class="form-group col-md-6" style="margin-top: 12px; height: 36px;">
            @php($checked =$advertisement->is_active == 1 || old('is_active') == 1 || is_null($advertisement->is_active) )
            @include('backend::partials.toggle-button',['value'=>'is_active','checked'=>$checked])
        </div>
        <div class="form-group col-md-12" style="padding-right: 0">
            <label for="fieldID4">Banner Picture</label>
            <div class="input-group">
                   <span class="input-group-btn btn-flat">
                     <button
                         type="button"
                         onclick="return openElFinder(event, 'feature_image');"
                         data-inputid="feature_image"
                         class="btn btn-primary  ">
                       <i class="fa fa-picture-o"></i> Choose
                     </button>
                   </span>
                {{Form::text('image',null,['id'=>'feature_image','class'=>'form-control'])}}
            </div>
            <img id="holder" style="margin-top:15px;height:100px;width: 250px;" alt=""
                 src="{{isset($advertisement) ? $advertisement->image : ''}}">
        </div>

{{--        <div class="form-group col-md-12" style="padding-right: 0">--}}
{{--            <label for="fieldID4">Banner Picture</label>--}}
{{--            <div class="input-group">--}}
{{--                   <span class="input-group-btn btn-flat">--}}
{{--                     <a id="banner_image" data-input="thumbnail" data-preview="holder" class="btn btn-primary">--}}
{{--                       <i class="fa fa-picture-o"></i> Choose--}}
{{--                     </a>--}}
{{--                   </span>--}}
{{--                <label for="image_label">--}}
{{--                </label>--}}
{{--                {{Form::text('image',null,['id'=>'image_label','class'=>'form-control'])}}--}}
{{--            </div>--}}
{{--            <img id="holder" style="margin-top:15px;height:100px;" alt=""--}}
{{--                 src="{{isset($advertisement) ? $advertisement->image : ''}}">--}}
{{--        </div>--}}

        <div class="form-group col-md-12 {{$errors->has('sub_description') ? 'has-error':''}}">
            {{ Form::label('sub_description', 'Sub Description:', ['class'=>' control-label '])}}
            {!! Form::textarea('sub_description', null, array('placeholder' => 'Enter sub description',
                    'class' => 'form-control','rows'=>'3')) !!}

        </div>
        <div class="form-group col-md-12 {{$errors->has('description') ? 'has-error':''}}">
            {{ Form::label('description', 'Description:', ['class'=>' control-label '])}}
            {!! Form::textarea('description', null, array('placeholder' => 'Enter description',
            'class' => 'form-control','rows'=>'5')) !!}
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route($routePrefix.'advertisements.index')}}" type="button"
           class="btn btn-default btn-flat pull-left">
            <i class="fa fa-arrow-left"></i>
            Close
        </a>
        <button type="submit" class="btn btn-flat btn-primary pull-right">
            <i class="fa fa-save"></i>
            Submit
        </button>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var routePrefix = '{{$edition}}';
            window.input_id = '';
            window.openElFinder = function (event, input_id) {
                event.preventDefault();

                window.single = true;
                window.old = false;
                window.input_id = input_id;
                let url = '/' + routePrefix + '/bl-secure/elfinder/popup/' + input_id;
                window.open(url, '_blank', 'scrollbars=yes,height=500,width=1000');

                return false;
            };

            // function to update the file selected by elfinder
            window.processSelectedFile = function (filePath, requestingField) {
                console.log(filePath);
                $('#' + requestingField).val(filePath).trigger('change');
            }
        });
    </script>
@endpush




