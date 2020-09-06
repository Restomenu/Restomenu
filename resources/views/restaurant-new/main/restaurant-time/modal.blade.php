<fieldset class="form-group main-fieldset" style="display: none" id="monday">
    <legend>@lang('Monday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('monday_mrng', ['0' => __("Closed"),'1' =>__("Open")],  null, ['id' => 'monday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('monday_mrng'))
            <p class="text-danger">{{ $errors->first('monday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('monday_evng', ['0' => __("Closed"),'1' =>__("Open")],  null, ['id' => 'monday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('monday_evng'))
            <p class="text-danger">{{ $errors->first('monday_evng') }}</p>
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

</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="tuesday">
    <legend>@lang('Tuesday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('tuesday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'tuesday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('tuesday_mrng'))
            <p class="text-danger">{{ $errors->first('tuesday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('tuesday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'tuesday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('tuesday_evng'))
            <p class="text-danger">{{ $errors->first('tuesday_evng') }}</p>
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
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="wednesday">
    <legend>@lang('Wednesday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('wednesday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'wednesday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('wednesday_mrng'))
            <p class="text-danger">{{ $errors->first('wednesday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('wednesday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'wednesday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('wednesday_evng'))
            <p class="text-danger">{{ $errors->first('wednesday_evng') }}</p>
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
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="thursday">
    <legend>@lang('Thursday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('thursday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'thursday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('thursday_mrng'))
            <p class="text-danger">{{ $errors->first('thursday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('thursday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'thursday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('thursday_evng'))
            <p class="text-danger">{{ $errors->first('thursday_evng') }}</p>
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
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="friday">
    <legend>@lang('Friday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('friday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'friday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('friday_mrng'))
            <p class="text-danger">{{ $errors->first('friday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('friday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'friday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('friday_evng'))
            <p class="text-danger">{{ $errors->first('friday_evng') }}</p>
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
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="saturday">
    <legend>@lang('Saturday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('saturday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'saturday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('saturday_mrng'))
            <p class="text-danger">{{ $errors->first('saturday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('saturday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'saturday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('saturday_evng'))
            <p class="text-danger">{{ $errors->first('saturday_evng') }}</p>
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
</fieldset>

<fieldset class="form-group main-fieldset" style="display: none" id="sunday">
    <legend>@lang('Sunday')</legend>

    <div class="form-group row">
        <label class="col-form-label col-sm-3">{{__('Morning Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('sunday_mrng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'sunday_mrng', 'class'=>"form-control"]) }}

            @if($errors->has('sunday_mrng'))
            <p class="text-danger">{{ $errors->first('sunday_mrng') }}</p>
            @endif
        </div>
    </div>

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
        <label class="col-form-label col-sm-3">{{__('Evening Status')}}</label>
        <div class="col-sm-7">
            {{ Form::select('sunday_evng', ['0' => __("Closed"),'1' =>__("Open")], null, ['id' => 'sunday_evng', 'class'=>"form-control"]) }}

            @if($errors->has('sunday_evng'))
            <p class="text-danger">{{ $errors->first('sunday_evng') }}</p>
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
</fieldset>