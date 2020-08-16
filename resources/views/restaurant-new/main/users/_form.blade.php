@push("stylesheets")
@endpush

<h3>{{__('Name')}}/{{__('Gender')}}</h3>
<section>
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
    <label class="col-form-label col-sm-2">{{__('Gender')}}</label>
    <div class="col-sm-6">

        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {{ Form::radio('gender', 'Male', true,['id'=>'gender_male']) }}
            </label>
            {{ Form::label('gender_male', __('Male')) }}
        </div>

        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {{ Form::radio('gender', 'Female', false,['id'=>'gender_female']) }}
            </label>
            {{ Form::label('gender_female', __('Female')) }}
        </div>

        @if($errors->has('gender'))
        <p class="text-danger">{{ $errors->first('gender') }}</p>
        @endif
    </div>
</div>

</section>

<h3>{{__('Email')}}/{{__('Password')}}</h3>
<section>

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
</section>

<h3>{{__('Address')}}</h3>
<section>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Address')}}</label>
    <div class="col-sm-6">
        {{ Form::textarea('address', null, ['id' => 'address', 'class'=>"form-control","rows"=>5]) }}
        @if($errors->has('address'))
        <p class="text-danger">{{ $errors->first('address') }}</p>
        @endif
    </div>
</div>
</section>

<h3>{{__('Phone')}}</h3>
<section>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Phone')}}</label>
    <div class="col-sm-6">
        {{ Form::text('phone', null, ['id' => 'phone', 'class'=>"form-control"]) }}
        @if($errors->has('phone'))
        <p class="text-danger">{{ $errors->first('phone') }}</p>
        @endif
    </div>
</div>

<section>
@push("scripts")

<script type="text/javascript">
        var form = $("#form_validate");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
      
            rules: {
                name: {
                    required: true
                },
                email:{
                    required: true,
                    email:true,
                    remote: function() {
                        @if(isset($result))
                        return "{{ url('users/checkUniqueEmail') }}/{{$result->id}}";
                        @else
                        return "{{ url('users/checkUniqueEmail') }}";
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
                }
            },
            messages:{
                name: {
                    required: "@lang('This field is required.')",
                },
                email:{
                    required: "@lang('This field is required.')",
                    email: "@lang('Please enter a valid email address.')",
                    remote: "@lang('Email already exists.')"
                },
                password:{
                    required: "@lang('This field is required.')",
                    minlength:"@lang('Please enter at least 8 characters.')"
                }
            },
        });
@include('restaurant-new.main.general.jquery-steps')

</script>

@endpush