@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                @if(isset($module_name))
                <h5 class="mt-1">{{ $module_name }}</h5>
                @endif
            </div>
            <div class="card-body">
                {!! Form::model($restaurantTime, array('url' => route('restaurant.restaurant-time-update'), 'method' =>
                'POST',
                "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'form_validate',
                'autocomplete'=>'off')) !!}

                <fieldset class="form-group">
                    <legend>@lang('Monday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('monday_mrng_start_time', $restaurantTime->monday_mrng_start_time ?? null, ['id' => 'monday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('monday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('monday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('monday_mrng_ending_time', $restaurantTime->monday_mrng_ending_time ?? null, ['id' => 'monday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('monday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('monday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('monday_evng_start_time', $restaurantTime->monday_evng_start_time ?? null, ['id' => 'monday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('monday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('monday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('monday_evng_ending_time', $restaurantTime->monday_evng_ending_time ?? null, ['id' => 'monday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('monday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('monday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Tuesday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('tuesday_mrng_start_time', $restaurantTime->tuesday_mrng_start_time ?? null, ['id' => 'tuesday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('tuesday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('tuesday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('tuesday_mrng_ending_time', $restaurantTime->tuesday_mrng_ending_time ?? null, ['id' => 'tuesday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('tuesday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('tuesday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('tuesday_evng_start_time', $restaurantTime->tuesday_evng_start_time ?? null, ['id' => 'tuesday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('tuesday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('tuesday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>


                        <div class="col-sm-3">
                            {{ Form::text('tuesday_evng_ending_time', $restaurantTime->tuesday_evng_ending_time ?? null, ['id' => 'tuesday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('tuesday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('tuesday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Wednesday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('wednesday_mrng_start_time', $restaurantTime->wednesday_mrng_start_time ?? null, ['id' => 'wednesday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('wednesday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('wednesday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('wednesday_mrng_ending_time', $restaurantTime->wednesday_mrng_ending_time ?? null, ['id' => 'wednesday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('wednesday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('wednesday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('wednesday_evng_start_time', $restaurantTime->wednesday_evng_start_time ?? null, ['id' => 'wednesday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('wednesday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('wednesday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('wednesday_evng_ending_time', $restaurantTime->wednesday_evng_ending_time ?? null, ['id' => 'wednesday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('wednesday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('wednesday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Thursday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('thursday_mrng_start_time', $restaurantTime->thursday_mrng_start_time ?? null, ['id' => 'thursday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('thursday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('thursday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('thursday_mrng_ending_time', $restaurantTime->thursday_mrng_ending_time ?? null, ['id' => 'thursday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('thursday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('thursday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('thursday_evng_start_time', $restaurantTime->thursday_evng_start_time ?? null, ['id' => 'thursday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('thursday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('thursday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('thursday_evng_ending_time', $restaurantTime->thursday_evng_ending_time ?? null, ['id' => 'thursday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('thursday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('thursday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Friday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('friday_mrng_start_time', $restaurantTime->friday_mrng_start_time ?? null, ['id' => 'friday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('friday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('friday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('friday_mrng_ending_time', $restaurantTime->friday_mrng_ending_time ?? null, ['id' => 'friday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('friday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('friday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('friday_evng_start_time', $restaurantTime->friday_evng_start_time ?? null, ['id' => 'friday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('friday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('friday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('friday_evng_ending_time', $restaurantTime->friday_evng_ending_time ?? null, ['id' => 'friday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('friday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('friday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Saturday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('saturday_mrng_start_time', $restaurantTime->saturday_mrng_start_time ?? null, ['id' => 'saturday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('saturday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('saturday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('saturday_mrng_ending_time', $restaurantTime->saturday_mrng_ending_time ?? null, ['id' => 'saturday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('saturday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('saturday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('saturday_evng_start_time', $restaurantTime->saturday_evng_start_time ?? null, ['id' => 'saturday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('saturday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('saturday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('saturday_evng_ending_time', $restaurantTime->saturday_evng_ending_time ?? null, ['id' => 'saturday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('saturday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('saturday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend>@lang('Sunday')</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Morning Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('sunday_mrng_start_time', $restaurantTime->sunday_mrng_start_time ?? null, ['id' => 'sunday_mrng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('sunday_mrng_start_time'))
                            <p class="text-danger">{{ $errors->first('sunday_mrng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('sunday_mrng_ending_time', $restaurantTime->sunday_mrng_ending_time ?? null, ['id' => 'sunday_mrng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('sunday_mrng_ending_time'))
                            <p class="text-danger">{{ $errors->first('sunday_mrng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">{{__('Evening Time')}}</label>
                        <div class="col-sm-3">
                            {{ Form::text('sunday_evng_start_time', $restaurantTime->sunday_evng_start_time ?? null, ['id' => 'sunday_evng_start_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('sunday_evng_start_time'))
                            <p class="text-danger">{{ $errors->first('sunday_evng_start_time') }}</p>
                            @endif
                        </div>

                        <label class="col-1 text-center col-form-label">{{__('To')}}</label>

                        <div class="col-sm-3">
                            {{ Form::text('sunday_evng_ending_time', $restaurantTime->sunday_evng_ending_time ?? null, ['id' => 'sunday_evng_ending_time', 'class'=>"form-control timepicker"]) }}
                            @if($errors->has('sunday_evng_ending_time'))
                            <p class="text-danger">{{ $errors->first('sunday_evng_ending_time') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>

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
            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")

<script>
    $('.timepicker').clockpicker({
        donetext: "@lang('Done')",
        // afterDone: function() {
        //     console.log("after done");
        // }
    });

    jQuery.validator.addMethod("hour", function(value, element) {
        return this.optional(element) || /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(value);
    }, '@lang("The time format is invalid.")');

    $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                monday_mrng_start_time: {
                    required: true,
                    hour:true
                },
                monday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                monday_evng_start_time: {
                    required: true,
                    hour:true
                },
                monday_evng_ending_time: {
                    required: true,
                    hour:true
                },
                tuesday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                tuesday_mrng_ending_time: {
                    required: true,
                    hour:true
                },
                tuesday_evng_start_time: {
                    required: true,
                    hour:true
                },
                tuesday_evng_ending_time:{
                    required: true,
                    hour:true
                },
                wednesday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                wednesday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                wednesday_evng_start_time:{
                    required: true,
                    hour:true
                },
                wednesday_evng_ending_time:{
                    required: true,
                    hour:true
                },
                thursday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                thursday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                thursday_evng_start_time:{
                    required: true,
                    hour:true
                },
                thursday_evng_ending_time:{
                    required: true,
                    hour:true
                },
                friday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                friday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                friday_evng_start_time:{
                    required: true,
                    hour:true
                },
                friday_evng_ending_time:{
                    required: true,
                    hour:true
                },
                saturday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                saturday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                saturday_evng_start_time:{
                    required: true,
                    hour:true
                },
                saturday_evng_ending_time:{
                    required: true,
                    hour:true
                },
                sunday_mrng_start_time:{
                    required: true,
                    hour:true
                },
                sunday_mrng_ending_time:{
                    required: true,
                    hour:true
                },
                sunday_evng_start_time:{
                    required: true,
                    hour:true
                },
                sunday_evng_ending_time:{
                    required: true,
                    hour:true
                }
            },
            messages: {
			    monday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    monday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    monday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    monday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    tuesday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    tuesday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    tuesday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    tuesday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    wednesday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    wednesday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    wednesday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    wednesday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    thursday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    thursday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    thursday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    thursday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    friday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    friday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    friday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    friday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    saturday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    saturday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    saturday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    saturday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    sunday_mrng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    sunday_mrng_ending_time: {
				    required: "@lang('This field is required.')",
                },
			    sunday_evng_start_time: {
				    required: "@lang('This field is required.')",
                },
			    sunday_evng_ending_time: {
				    required: "@lang('This field is required.')",
                },
		    },
        });
</script>

@endpush