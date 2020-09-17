@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@push("stylesheets")
<style>
    select {
        color: #000;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">{{isset($module_name) ? __(Str::plural($module_name)) : ''}}</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="hr-line-dashed"></div>

                {!! Form::model($setting, array('url' => route('restaurant.restaurant-setting-update'), 'method' =>
                'POST',
                "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'setting_form_validate',
                'autocomplete'=>'off')) !!}


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
                            {{-- <a href="{{ URL::previous() }}" class="btn btn-light mr-2">{{__('Cancel')}}</a> --}}
                            <button class="btn btn-primary col-sm-4" id="submit_form_button" type="submit">{{__('Update')}}</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <br><br>

            </div>
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">{{__('Restaurant Timings')}}</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">{{__("Day")}}</th>
                                <th scope="col">{{__("Morning")}}</th>
                                <th scope="col">{{__("Noon")}}</th>
                                <th scope="col">{{__("Afternoon")}}</th>
                                <th scope="col">{{__("Evening")}}</th>
                                <th scope="col">{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{__("Monday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->monday_mrng == 1)

                                <td>{{$restaurantTime->monday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->monday_mrng_ending_time}}</td>

                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->monday_evng == 1)

                                <td>{{$restaurantTime->monday_evng_start_time}}</td>
                                <td>{{$restaurantTime->monday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                <td>
                                    <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="monday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Tuesday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->tuesday_mrng == 1 )
                                <td>{{$restaurantTime->tuesday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->tuesday_mrng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->tuesday_evng == 1 )
                                <td>{{$restaurantTime->tuesday_evng_start_time}}</td>
                                <td>{{$restaurantTime->tuesday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif
                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="tuesday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Wednesday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->wednesday_mrng == 1 )

                                <td>{{$restaurantTime->wednesday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->wednesday_mrng_ending_time}}</td>

                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->wednesday_evng == 1 )
                                <td>{{$restaurantTime->wednesday_evng_start_time}}</td>
                                <td>{{$restaurantTime->wednesday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="wednesday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Thursday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->thursday_mrng == 1)
                                <td>{{$restaurantTime->thursday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->thursday_mrng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->thursday_evng == 1)
                                <td>{{$restaurantTime->thursday_evng_start_time}}</td>
                                <td>{{$restaurantTime->thursday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="thursday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Friday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->friday_mrng == 1 )
                                <td>{{$restaurantTime->friday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->friday_mrng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->friday_evng == 1 )
                                <td>{{$restaurantTime->friday_evng_start_time}}</td>
                                <td>{{$restaurantTime->friday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="friday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Saturday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->saturday_mrng == 1 )
                                <td>{{$restaurantTime->saturday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->saturday_mrng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->saturday_evng == 1 )
                                <td>{{$restaurantTime->saturday_evng_start_time}}</td>
                                <td>{{$restaurantTime->saturday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif
                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="saturday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">{{__("Sunday")}}</th>
                                @if(isset($restaurantTime) && $restaurantTime->sunday_mrng == 1 )
                                <td>{{$restaurantTime->sunday_mrng_start_time}}</td>
                                <td>{{$restaurantTime->sunday_mrng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif

                                @if(isset($restaurantTime) && $restaurantTime->sunday_evng == 1 )
                                <td>{{$restaurantTime->sunday_evng_start_time}}</td>
                                <td>{{$restaurantTime->sunday_evng_ending_time}}</td>
                                @else
                                <td class="text-center" colspan="2">@lang('Closed')</td>
                                @endif
                                <td> <a class="btn btn-primary change-status-btn ml-2" href="#" data-day="sunday"><i class='fa fa-edit'></i></a></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" role="dialog" aria-labelledby="feedbackModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    @lang('Change Restaurant Timings')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($restaurantTime, array('url' => route('restaurant.restaurant-setting-update'), 'method' =>
            'POST',
            "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'form_validate',
            'autocomplete'=>'off')) !!}

            <div class="card">

                <div class="card-body" id="showData">

                    @include('restaurant-new.main.restaurant-setting.modal')

                </div>
            </div>
            <div class="modal-footer feedback-modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                <button type="button" class="btn btn-primary shadow-none btn-restomenu-primary status-submit-btn">@lang('Save')</button>
            </div>
            {!! Form::close() !!}
            {{-- </form> --}}
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).on('click', ".change-status-btn", function(e) {
        $('#statusModal').modal('show');
        var day = $(this).data('day');
        $('#' + day).show();

    })
    $('#statusModal').on('hidden.bs.modal', function() {
        $('.main-fieldset').hide();

    });

    $(document).on('click', ".status-submit-btn", function(e) {
        $('#form_validate').submit();
    });

    $('.timepicker').clockpicker({
        donetext: "@lang('Done')",
        // afterDone: function() {
        //     console.log("after done");
        // }
    });

    // jQuery.validator.addMethod("hour", function(value, element) {
    //     return this.optional(element) || /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(value);
    // }, '@lang("The time format is invalid.")');

    // $("#form_validate").validate({
    //     ignore: [],
    //     errorElement: 'p',
    //     errorClass: 'text-danger',
    //     normalizer: function(value) {
    //         return $.trim(value);
    //     },
    //     rules: {
    //         monday_mrng_start_time: {
    //             required: true,
    //             hour:true
    //         },
    //         monday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         monday_evng_start_time: {
    //             required: true,
    //             hour:true
    //         },
    //         monday_evng_ending_time: {
    //             required: true,
    //             hour:true
    //         },
    //         tuesday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         tuesday_mrng_ending_time: {
    //             required: true,
    //             hour:true
    //         },
    //         tuesday_evng_start_time: {
    //             required: true,
    //             hour:true
    //         },
    //         tuesday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         wednesday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         wednesday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         wednesday_evng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         wednesday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         thursday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         thursday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         thursday_evng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         thursday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         friday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         friday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         friday_evng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         friday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         saturday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         saturday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         saturday_evng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         saturday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         sunday_mrng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         sunday_mrng_ending_time:{
    //             required: true,
    //             hour:true
    //         },
    //         sunday_evng_start_time:{
    //             required: true,
    //             hour:true
    //         },
    //         sunday_evng_ending_time:{
    //             required: true,
    //             hour:true
    //         }
    //     },
    //     messages: {
    //         monday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         monday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         monday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         monday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         tuesday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         tuesday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         tuesday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         tuesday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         wednesday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         wednesday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         wednesday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         wednesday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         thursday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         thursday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         thursday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         thursday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         friday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         friday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         friday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         friday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         saturday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         saturday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         saturday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         saturday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         sunday_mrng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         sunday_mrng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         sunday_evng_start_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //         sunday_evng_ending_time: {
    //             required: "@lang('This field is required.')",
    //         },
    //     },
    // });
</script>
@endpush