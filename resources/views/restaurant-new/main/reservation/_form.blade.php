<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('First name')}}</label>
            <div class="col-sm-6">
                {{ Form::text('first_name', null, ['id' => 'first_name', 'class'=>"form-control"]) }}
                @if($errors->has('first_name'))
                <p class="text-danger">{{ $errors->first('first_name') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Last name')}}</label>
            <div class="col-sm-6">
                {{ Form::text('last_name', null, ['id' => 'last_name', 'class'=>"form-control"]) }}
                @if($errors->has('last_name'))
                <p class="text-danger">{{ $errors->first('last_name') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Email')}}</label>
            <div class="col-sm-6">
                {{ Form::text('email', null, ['id' => 'email', 'class'=>"form-control"]) }}
                @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Number of people')}}</label>
            <div class="col-sm-6">
                {{ Form::number('number_of_people', null, ['id' => 'number_of_people', 'class'=>"form-control","min"=>'1']) }}
                @if($errors->has('number_of_people'))
                <p class="text-danger">{{ $errors->first('number_of_people') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Arrival time')}}</label>
            <div class="col-sm-3">
                <div class="input-group date datepicker" id="checkInDatePicker">
                    {{ Form::text('checkin_date', null, ['id' => 'checkin_date', 'class'=>"form-control"]) }}
                    <span class="input-group-addon"><i data-feather="calendar"></i></span>
                </div>
            </div>
            <div class="col-sm-3">

                <div class="input-group date timepicker" id="checkOutDatetimepicker" data-target-input="nearest">
                    {{ Form::text('checkin_time', null, ['id' => 'checkin_time', 'class'=>"form-control datetimepicker-input","data-target"=>"#checkOutDatetimepicker"]) }}
                    <div class="input-group-append" data-target="#checkOutDatetimepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i data-feather="clock"></i></div>
                    </div>
                </div>

                <input type="hidden" name="checkin_at" class="checkin-at-input">

            </div>
            @if($errors->has('checkin_at'))
            <p class="text-danger">{{ $errors->first('checkin_at') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Phone number')}}</label>
            <div class="col-sm-6">
                {{ Form::text('phone', null, ['id' => 'phone', 'class'=>"form-control"]) }}
                @if($errors->has('phone'))
                <p class="text-danger">{{ $errors->first('phone') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push("scripts")

<script type="text/javascript">
    $(document).ready(function() {

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#checkInDatePicker').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            endDate: "tomorrow",
            autoclose: false
        });
        $('#checkInDatePicker').datepicker('setDate', today);

        $('#checkOutDatetimepicker').datetimepicker({
            format: 'HH:mm',
            defaultDate:date
        });

        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: false,
                    email: true
                },
                number_of_people: {
                    required: true,
                },
                phone: {
                    required: true,
                    number: true
                },
            },
            messages: {
                first_name: {
                    required: "@lang('This field is required.')",
                },
                last_name: {
                    required: "@lang('This field is required.')",
                },
                email: {
                    email: "@lang('Please enter a valid email address.')",
                },
                number_of_people: {
                    required: "@lang('This field is required.')",
                },
                phone: {
                    required: "@lang('This field is required.')",
                    number: "@lang('Please enter a valid phone number.')",
                },
            },
            submitHandler: function (form) {
                
                const checkin_date = $('#checkin_date').val();
                const checkin_time = $('#checkin_time').val();

                var checkInAt = checkin_date +' '+ checkin_time;
                $('.checkin-at-input').val(checkInAt);
                
                form.submit();
            }
        });
    });
</script>
@endpush