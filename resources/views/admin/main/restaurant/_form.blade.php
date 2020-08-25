@push("styles")
<style>
    .col-form-label {
        padding-left: 15px;
        padding-right: 15px;
        font-weight: bold;
    }
</style>
@endpush

<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Name')}}</label>
    <div class="col-sm-6">
        {{ Form::text('name', null, ['id' => 'name', 'class'=>"form-control"]) }}
        @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Email')}}</label>
    <div class="col-sm-6">
        {{ Form::text('email', null, ['id' => 'email', 'class'=>"form-control"]) }}
        @if($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Password')}}</label>
    <div class="col-sm-6">
        {{Form::input('password', 'password', null,['id' => 'password', 'class'=>"form-control"])}}
        @if($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Logo')}}</label>
    <div class="col-sm-6">
        {{ Form::file("image", ["class"=>"form-control", "id" => "image"]) }}

        @if($errors->has('image'))
        <p class="text-danger">{{ $errors->first('image') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Color')}}</label>
    <div class="col-sm-6">
        {{ Form::text('color', (isset($result) && $result->setting->menu_primary_color) ? $result->setting->menu_primary_color : null, ['id' => 'color', 'class'=>"form-control","placeholder"=>"#CACC2D"]) }}
        @if($errors->has('color'))
        <p class="text-danger">{{ $errors->first('color') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Slug')}}</label>
    <div class="col-sm-6">
        {{ Form::text('slug', null, ['id' => 'slug', 'class'=>"form-control"]) }}
        @if($errors->has('slug'))
        <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Status')}}</label>
    <div class="col-sm-6">
        {{ Form::select('status', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'status', 'class'=>"form-control"]) }}

        @if($errors->has('status'))
        <p class="text-danger">{{ $errors->first('status') }}</p>
        @endif
    </div>
</div>

@push("scripts")

<script type="text/javascript">
    $(document).ready(function() {

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
                name: {
                    required: true,
                    maxlength: 191
                },
                email:{
                    required: true,
                    email:true,
                    remote: function() {
                        @if(isset($result))

                        var url = '{{ route("restaurantsCheckUniqueEmail", ":id") }}';
                        url = url.replace(':id', "{{$result->id}}");
                        return url;

                        @else
                        return "{{ route('restaurantsCheckUniqueEmail') }}";
                        @endif
					}
                },
                password:{
                    required: function() {
						@if(!isset($result))
					
                        return true;

                        @else
                        return false;
                        
						@endif
					},
                    minlength:8
                },
                image:{
                    required: function() {
						@if(!isset($result))
					
                        return true;

                        @else
                        return false;
                        
						@endif
					},
                },
                slug:{
                    required: true,
                    pattern: /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/,
                    remote: function() {
                        @if(isset($result))

                        var url = '{{ route("restaurantsCheckUniqueSlug", ":id") }}';
                        url = url.replace(':id', "{{$result->id}}");
                        return url;

                        @else
                        return "{{ route('restaurantsCheckUniqueSlug') }}";
                        @endif
					}
                },
                color:{
                    required: true,
                    colorHex:true
                }
            },
            messages: {
			    name: {
				    required: "@lang('This field is required.')",
                    maxlength:"@lang('Please enter no more than 191 characters.')"
                },
                email:{
                    required: "@lang('This field is required.')",
                    email: "@lang('Please enter a valid email address.')",
                    remote: "@lang('Email already exists.')"
                },
                password:{
                    required: "@lang('This field is required.')",
                    minlength:"@lang('Please enter at least 8 characters.')"
                },
                image:{
                    required: "@lang('This field is required.')",
                },
                slug:{
                    required: "@lang('This field is required.')",
                    remote: "@lang('Slug already exist.')",
                    pattern: "@lang('The custom URL may only contain letters, numbers and dashes.')",
                },
                color:{
                    required: "@lang('This field is required.')",
                }
                
		    },
        });
    });
</script>

@endpush