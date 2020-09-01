<fieldset class="form-group main-fieldset" style="display: none" id="monday">
    <legend>@lang('Monday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('monday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'monday', 'class'=>"form-control"]) }}

            @if($errors->has('monday'))
            <p class="text-danger">{{ $errors->first('monday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="tuesday">
    <legend>@lang('Tuesday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('tuesday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'tuesday', 'class'=>"form-control"]) }}

            @if($errors->has('tuesday'))
            <p class="text-danger">{{ $errors->first('tuesday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="wednesday">
    <legend>@lang('Wednesday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('wednesday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'wednesday', 'class'=>"form-control"]) }}

            @if($errors->has('wednesday'))
            <p class="text-danger">{{ $errors->first('wednesday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="thursday">
    <legend>@lang('Thursday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('thursday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'thursday', 'class'=>"form-control"]) }}

            @if($errors->has('thursday'))
            <p class="text-danger">{{ $errors->first('thursday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="friday">
    <legend>@lang('Friday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('friday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'friday', 'class'=>"form-control"]) }}

            @if($errors->has('friday'))
            <p class="text-danger">{{ $errors->first('friday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="saturday">
    <legend>@lang('Saturday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('saturday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'saturday', 'class'=>"form-control"]) }}

            @if($errors->has('saturday'))
            <p class="text-danger">{{ $errors->first('saturday') }}</p>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="sunday">
    <legend>@lang('Sunday')</legend>
    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Time')}}</label>
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
        <label class="col-form-label col-sm-3">{{__('Evening Time')}}</label>
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

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('sunday', ['1' =>__("Open "),'0' => __("Closed ")], null, ['id' => 'sunday', 'class'=>"form-control"]) }}

            @if($errors->has('sunday'))
            <p class="text-danger">{{ $errors->first('sunday') }}</p>
            @endif
        </div>
    </div>
</fieldset>