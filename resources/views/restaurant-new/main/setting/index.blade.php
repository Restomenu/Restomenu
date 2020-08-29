@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')


{{-- <nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{$module_route}}">{{ isset($module_name) ? __($module_name) : '' }}</a>
</li>
<li class="breadcrumb-item active" aria-current="page"><strong>{{__('Edit')}}</strong></li>
</ol>
</nav> --}}
{{-- {{module_route}}$ --}}
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                @if(isset($module_name))
                <h5 class="mt-1">{{ $module_name }} {{__('Edit')}}</h5>
                @endif
            </div>
            <div class="card-body">
                {!! Form::model($result, array('url' => route('restaurant.settings-update'), 'method' => 'POST',
                "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'form_validate',
                'autocomplete'=>'off')) !!}

                @if (isset($result->site_logo))
                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Site Logo')}}</label>
                    <div class="col-sm-6">
                        <img class="col-sm-6" src="{{$result->logo_full_path}}" alt="">

                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Upload New Site Logo')}}</label>

                    <div class="col-sm-6">
                        {{ Form::file("site_logo", ["class"=>"form-control", "id" => "site_logo"]) }}
                        @if($errors->has('site_logo'))
                        <p class="text-danger">{{ $errors->first('site_logo') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Site Name')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('site_name', null, ['id' => 'site_name', 'class'=>"form-control"]) }}
                        @if($errors->has('site_name'))
                        <p class="text-danger">{{ $errors->first('site_name') }}</p>
                        @endif
                    </div>
                </div>

                <fieldset class="form-group">
                    <legend class="scheduler-border">Site Language</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Language English')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('language_english', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'language_english', 'class'=>"form-control"]) }}

                            @if($errors->has('language_english'))
                            <p class="text-danger">{{ $errors->first('language_english') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Language Dutch')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('language_dutch', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'language_dutch', 'class'=>"form-control"]) }}

                            @if($errors->has('language_dutch'))
                            <p class="text-danger">{{ $errors->first('language_dutch') }}</p>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Language French')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('language_french', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'language_french', 'class'=>"form-control"]) }}

                            @if($errors->has('language_french'))
                            <p class="text-danger">{{ $errors->first('language_french') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="scheduler-border">Admin Language</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Admin Language English')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('admin_language_english', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'admin_language_english', 'class'=>"form-control"]) }}

                            @if($errors->has('admin_language_english'))
                            <p class="text-danger">{{ $errors->first('admin_language_english') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Admin Language Dutch')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('admin_language_dutch', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'admin_language_dutch', 'class'=>"form-control"]) }}

                            @if($errors->has('admin_language_dutch'))
                            <p class="text-danger">{{ $errors->first('admin_language_dutch') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Admin Language French')}}</label>
                        <div class="col-sm-6">
                            {{ Form::select('admin_language_french', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'admin_language_french', 'class'=>"form-control"]) }}

                            @if($errors->has('admin_language_french'))
                            <p class="text-danger">{{ $errors->first('admin_language_french') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Defualt Language')}}</label>
                    <div class="col-sm-6">
                        {{ Form::select('defualt_language', $selectedLanguage,  (isset($result) ? $result->defualt_language : null), ['id'=>'defualt_language',"class"=>"form-control"]) }}


                        @if($errors->has('language_french'))
                        <p class="text-danger">{{ $errors->first('language_french') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Color')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('menu_primary_color', (isset($result) && $result->menu_primary_color) ? $result->menu_primary_color : null, ['id' => 'color', 'class'=>"form-control","placeholder"=>"#CACC2D"]) }}
                        @if($errors->has('menu_primary_color'))
                        <p class="text-danger">{{ $errors->first('menu_primary_color') }}</p>
                        @endif
                    </div>
                </div>

                <fieldset class="form-group">
                    <legend class="scheduler-border">Change Password</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Current Password')}}</label>
                        <div class="col-sm-6">

                            {{ Form::text('old_password', null, ['id' => 'old_password', 'class'=>"form-control"]) }}

                            @if($errors->has('old_password'))
                            <p class="text-danger">{{ $errors->first('old_password') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('New Password')}}</label>
                        <div class="col-sm-6">

                            {{ Form::text('password', null, ['id' => 'password', 'class'=>"form-control"]) }}

                            @if($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Confirm Password')}}</label>
                        <div class="col-sm-6">

                            {{ Form::text('password_confirmation', null, ['id' => 'password_confirmation', 'class'=>"form-control"]) }}
                            @if($errors->has('password_confirmation'))
                            <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>
                <div class="hr-line-dashed"></div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Mail Address')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('email', auth()->guard('restaurant')->user()->email, ['id' => 'email', 'class'=>"form-control"]) }}
                        @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Phone Number')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('phone', auth()->guard('restaurant')->user()->phone, ['id' => 'phone', 'class'=>"form-control"]) }}
                        @if($errors->has('phone'))
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Facebook URL')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('fb_url', null, ['id' => 'fb_url', 'class'=>"form-control"]) }}
                        @if($errors->has('fb_url'))
                        <p class="text-danger">{{ $errors->first('fb_url') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Instagram URL')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('ig_url', null, ['id' => 'ig_url', 'class'=>"form-control"]) }}
                        @if($errors->has('ig_url'))
                        <p class="text-danger">{{ $errors->first('ig_url') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-2">{{__('Twitter URL')}}</label>
                    <div class="col-sm-6">
                        {{ Form::text('tw_url', null, ['id' => 'tw_url', 'class'=>"form-control"]) }}
                        @if($errors->has('tw_url'))
                        <p class="text-danger">{{ $errors->first('tw_url') }}</p>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="tr-btn-set">
                            <a href="{{ URL::previous() }}" class="btn btn-light mr-2">{{__('Cancel')}}</a>
                            <button class="btn btn-primary " id="submit_form_button"
                                type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @yield('additional-content')
            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")

<script type="text/javascript">
    $(document).ready(function() {
        $('#morning_start_time,#morning_end_time,#evening_start_time,#evening_end_time').clockpicker({
            donetext: "@lang('Done')",
            // afterDone: function() {
            //     console.log("after done");
            // }
        });

        jQuery.validator.addMethod("colorHex", function(value, element) {
		    return this.optional(element) || /^#(?:[0-9a-fA-F]{3}){1,2}$/.test(value);
	    }, '@lang("The color hex format is invalid.")');

        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                site_name: {
                    required: true,
                    maxlength: 191
                },
                menu_primary_color:{
                    required: true,
                    colorHex:true
                },
            },
            messages: {
			    site_name: {
				    required: "@lang('This field is required.')",
                    maxlength:"@lang('Please enter no more than 191 characters.')"
                },
                menu_primary_color:{
                    required: "@lang('This field is required.')",
                },
		    },
        });
    });
</script>

@endpush