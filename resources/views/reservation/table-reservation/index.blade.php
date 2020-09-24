@extends('reservation.layouts.default')

@section('title', 'Reservation')

@push("stylesheets")
<style>
    .steps ul:before {
        /* content: "Book A Table"; */
        content: attr(data-title);
        font-size: 22px;
        font-family: "Poppins-SemiBold";
        color: #333;
        top: -38px;
        position: absolute;
    }

    .steps ul.step-2:before {
        /* content: "Contact Information"; */
        content: attr(data-title-2);
    }

    .steps ul.step-3:before {
        /* content: "Your Order"; */
        content: attr(data-title-3);
    }

    .steps ul.step-4:before {
        /* content: "Billing Method"; */
        content: attr(data-title-3);
    }
</style>
@endpush

@section('content')

<div class="reservation-header">
    <img class="restaurant-logo-at-selection"
        src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />
</div>
<div class="text-center mb-4">

    @if (app()->getLocale() == 'nl')
    <a href="{{ route('menu-nl',['slug' => $restaurant->slug]) }}" target="_blank"
        class="btn btn-primary rm-btn-primary">@lang('Go To Menu') <i class="fa fa-external-link ml-1"
            aria-hidden="true"></i></a>
    @elseif(app()->getLocale() == 'fr')
    <a href="{{route('menu-fr',['slug' => $restaurant->slug])}}" target="_blank"
        class="btn btn-primary rm-btn-primary">@lang('Go To Menu') <i class="fa fa-external-link ml-1"
            aria-hidden="true"></i> </a>
    @elseif(app()->getLocale() == 'en')
    <a href="{{route('menu-en',['slug' => $restaurant->slug])}}" target="_blank"
        class="btn btn-primary rm-btn-primary">@lang('Go To Menu') <i class="fa fa-external-link ml-1"
            aria-hidden="true"></i> </a>
    @endif

</div>
<div class="wrapper-container">
    <div class="wrapper">
        <form action="{{route('reservation.reservation-save',['slug' => $restaurant->slug])}}" method="post"
            id="visitorForm" class="reservation-form">
            <div id="wizard">
                <!-- SECTION 1 -->
                <h4></h4>
                <section>
                    @if ($restaurant->restaurantTime)
                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <h5>@lang('Opening hours')</h5>
                        </div>
                        <div class="col-12">
                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Monday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">

                                    @if (!$restaurant->restaurantTime->monday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{ $restaurant->restaurantTime->monday_mrng_start_time ?? null  }}
                                    :
                                    {{ $restaurant->restaurantTime->monday_mrng_ending_time?? null}}
                                    @endif

                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">

                                    @if (!$restaurant->restaurantTime->monday_evng)
                                    @lang('Closed')
                                    @else
                                    {{ $restaurant->restaurantTime->monday_evng_start_time ?? null }}
                                    :
                                    {{ $restaurant->restaurantTime->monday_evng_ending_time ?? null }}
                                    @endif
                                </div>

                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Tuesday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->tuesday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->tuesday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->tuesday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->tuesday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->tuesday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->tuesday_evng_ending_time ?? null}}
                                    @endif
                                </div>

                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Wednesday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->wednesday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->wednesday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->wednesday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->wednesday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->wednesday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->wednesday_evng_ending_time ?? null}}
                                    @endif
                                </div>

                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Thursday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->thursday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->thursday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->thursday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->thursday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->thursday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->thursday_evng_ending_time ?? null}}
                                    @endif
                                </div>

                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Friday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->friday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->friday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->friday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->friday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->friday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->friday_evng_ending_time ?? null}}
                                    @endif
                                </div>
                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Saturday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->saturday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->saturday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->saturday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->saturday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->saturday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->saturday_evng_ending_time ?? null}}
                                    @endif
                                </div>
                            </div>

                            <div class="row time-row">
                                <div class="col-12 col-sm-4 font-weight-bold">
                                    <div>@lang('Sunday')</div>
                                </div>

                                <div class="col-5 col-sm-3 text-left text-sm-center pr-0">
                                    @if (!$restaurant->restaurantTime->sunday_mrng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->sunday_mrng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->sunday_mrng_ending_time ?? null}}
                                    @endif
                                </div>
                                <div class="col-1 col-sm-1 text-left text-sm-center">
                                    |
                                </div>
                                <div class="col-5 col-sm-3 text-left text-sm-center pl-sm-0">
                                    @if (!$restaurant->restaurantTime->sunday_evng)
                                    @lang('Closed')
                                    @else
                                    {{$restaurant->restaurantTime->sunday_evng_start_time ?? null}}
                                    :
                                    {{$restaurant->restaurantTime->sunday_evng_ending_time ?? null}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="locale" value="{{$locale}}">

                    <div class="row">
                        <div class="form-group col-12 col-sm-6">
                            <label for="">@lang('Reservation Date')</label>
                            <div class="input-group date" id="appointment_date" data-target-input="nearest">
                                <input type="text" id="reservation-date-input"
                                    class="form-control datetimepicker-input rm-text-input shadow-none"
                                    name="appointment_date" data-target="#appointment_date" data-toggle="datetimepicker"
                                    placeholder="@lang('Select Date')" autocomplete="off" />
                                <div class="input-group-append" data-target="#appointment_date"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text input-group-text-no-border"><i
                                            class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-6">
                            <label for="">@lang('Reservation Time')</label>
                            <div class="input-group date" id="appointment_time" data-target-input="nearest">
                                <input type="text" id="reservation-time-input"
                                    class="form-control datetimepicker-input rm-text-input shadow-none"
                                    name="appointment_time" data-target="#appointment_time"
                                    placeholder="@lang('Select Time')" data-toggle="datetimepicker"
                                    autocomplete="off" />
                                <div class="input-group-append" data-target="#appointment_time"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text input-group-text-no-border"><i
                                            class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="">@lang('Adults')</label>
                            <input type="number" class="form-control rm-text-input shadow-none" name="adults"
                                id="adults" placeholder="@lang('Adults')" min="1">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">@lang('Kids')</label>
                            <input type="number" class="form-control rm-text-input shadow-none" name="kids" id="kids"
                                placeholder="@lang('Kids')" min="0">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">@lang('Total People')</label>
                            <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people"
                                id="number_of_people" placeholder="@lang('Total People')" min="1" readonly>
                        </div>
                    </div>

                </section>

                <!-- SECTION 2 -->
                <h4></h4>
                <section>
                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="first_name"
                            id="first_name" placeholder="@lang('First name')">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="last_name"
                            id="last_name" placeholder="@lang('Last name')">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control rm-text-input shadow-none" name="email" id="email"
                            placeholder="@lang('Enter your email (optional)')">
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">+32</span>
                            </div>
                            <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone"
                                placeholder="@lang('Phone number')">
                        </div>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_terms_checked" value="1"> <a
                                href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">@lang('I agree
                                to the terms of service.')</a>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="have_covid" value="0">@lang('I confirm to have no COVID
                            symptoms.')</a>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_agreed" value="1">@lang('Agree with submitting your
                            information to our customers record.')</a>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    {{-- <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_terms_checked" value="1">
                        <a href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">@lang('I agree to
                    the
                    terms of service.')</a>
                    </label>
            </div>

            <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="is_agreed" value="1">
                    @lang('Agree with submitting your information to our customers record.')
                </label>
            </div> --}}
            </section>

            <!-- SECTION 3 -->
            <h4></h4>
            <section>
                <div class="contact-info-confirm">
                    <h5 class="py-3">@lang("Contact Information")</h5>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('First name')
                        </div>
                        <div class="col-6 col-sm-6 word-wrap" id="fname-confirm-text">

                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Last name')
                        </div>
                        <div class="col-6 col-sm-6 word-wrap" id="lname-confirm-text">

                        </div>
                    </div>
                    <div class="row py-2 email-row d-none">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Email')
                        </div>
                        <div class="col-6 col-sm-6 word-wrap" id="email-confirm-text">

                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Phone number')
                        </div>
                        <div class="col-6 col-sm-6 word-wrap" id="phone-confirm-text">

                        </div>
                    </div>
                </div>
                <div class="book-table-confirm">
                    <h5 class="py-3">@lang("Reservation Information")</h5>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Reservation Date')
                        </div>
                        <div class="col-6 col-sm-6" id="date-confirm-text">

                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Reservation Time')
                        </div>
                        <div class="col-6 col-sm-6" id="time-confirm-text">

                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Adults')
                        </div>
                        <div class="col-6 col-sm-6" id="adults-confirm-text">
                            -
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Kids')
                        </div>
                        <div class="col-6 col-sm-6" id="kids-confirm-text">
                            -
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 col-sm-4 font-weight-bold">
                            @lang('Total People')
                        </div>
                        <div class="col-6 col-sm-6" id="total-people-confirm-text">

                        </div>
                    </div>
                </div>
            </section>

            {{-- <!-- SECTION 4 -->
            <h4 data-after="Billing Details 1"></h4>
            <section>
                <div class="checkbox-circle">
                    <label class="active">
                        <input type="radio" name="billing method" value="Direct bank transfer" checked>Direct bank
                        transfer>
                        <span class="checkmark"></span>
                        <div class="tooltip">
                            Make your payment directly into our bank account. Please use your Order ID as the payment
                            reference. Your order will not be shipped until the funds have cleared in our account.
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="billing method" value="Check payments">Check payments
                        <span class="checkmark"></span>
                        <div class="tooltip">
                            Please send a check to Store Name, Store Street, Store Town, Store State / County, Store
                            Postcode.
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="billing method" value="Cash on delivery">Cash on delivery
                        <span class="checkmark"></span>
                        <div class="tooltip">
                            Pay with cash upon delivery.
                        </div>
                    </label>
                </div>
            </section> --}}
    </div>
    </form>
</div>
</div>

<!-- select language button -->
@if($restaurant->setting->language_english + $restaurant->setting->language_dutch +
$restaurant->setting->language_french > 1)
<div class="back-refer" id="back-button">
    <a href="{{route('reservation.select-language',['slug' => $restaurant->slug])}}">
        <img class="back-button-collection" src="{{asset('front/menu/images/back_button.svg')}}" />
        @if (app()->getLocale() == 'nl')
        Kies een&nbsp;<strong>taal</strong>
        @elseif(app()->getLocale() == 'fr')
        Choisissez une&nbsp;<strong>langue</strong>
        @elseif(app()->getLocale() == 'en')
        Pick a&nbsp;<strong>language</strong>
        @endif
    </a>
</div>
@endif
@endsection

@push('scripts')
<script>
    var is_async_step = false;
    $("#wizard").steps({
    headerTag: "h4",
    bodyTag: "section",
    transitionEffect: "fade",
    enableAllSteps: true,
    transitionEffectSpeed: 500,
    onStepChanging: function(event, currentIndex, newIndex) {
        form.valid();
        if (!form.valid()) {
            return false;
        }

        if (is_async_step) {
            is_async_step = false;
            //ALLOW NEXT STEP
            return true;
        }

        if (currentIndex == 0) {
            var reservationTimeCheckUrl = '{{ route("reservation.reservation-time-check", ":slug") }}';
            reservationTimeCheckUrl = reservationTimeCheckUrl.replace(':slug', "{{$restaurant->slug}}");

            $.ajax({
                url: reservationTimeCheckUrl,
                method: 'POST',
                data: {
                    'appointment_date': $('#reservation-date-input').val(),
                    'appointment_time':  $('#reservation-time-input').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(data, status, xhr) {
                    //Add below 2 lines for every Index(Steps).                            
                    is_async_step = true;
                    //This will move to next step.
                    $(".steps ul").addClass("step-2");
                    $("#wizard").steps("next");
                },
                error: function(xhr, status, error) {
                    fnToastWarning(xhr.responseJSON.message);
                    return false;
                },
                
            });
            return false;
        }

        if (newIndex === 1) {
            $(".steps ul").addClass("step-2");
        } else {
            $(".steps ul").removeClass("step-2");
        }
        if (newIndex === 2) {
            $(".steps ul").addClass("step-3");
            // $(".actions ul").addClass("step-last");
        } else {
            $(".steps ul").removeClass("step-3");
            // $(".actions ul").removeClass("step-last");
        }
        if (newIndex === 3) {
            $(".steps ul").addClass("step-4");
            $(".actions ul").addClass("step-last");
        } else {
            $(".steps ul").removeClass("step-4");
            $(".actions ul").removeClass("step-last");
        }
        return true;
    },
    labels: {
        finish: "Finish",
        next: "Next",
        previous: "Previous"
    },
    onFinished: function(event, currentIndex) {
        form.submit();
    }
});

    // Custom Steps Jquery Steps
    $(".wizard > .steps li a").click(function() {
        if (!form.valid()) {
            return false;
        }
        $(this)
            .parent()
            .addClass("checked");
        $(this)
            .parent()
            .prevAll()
            .addClass("checked");
        $(this)
            .parent()
            .nextAll()
            .removeClass("checked");
    });
    // Custom Button Jquery Steps
    $(".forward").click(function() {
        $("#wizard").steps("next");
    });
    $(".backward").click(function() {
        $("#wizard").steps("previous");
    });
    // Checkbox
    $(".checkbox-circle label").click(function() {
        $(".checkbox-circle label").removeClass("active");
        $(this).addClass("active");
    });

    $(".steps ul").attr('data-title','@lang("Book A Table")');
    $(".steps ul").attr('data-title-2','@lang("Contact Information")');
    $(".steps ul").attr('data-title-3','@lang("Confirm")');

    var dateNow = new Date().setHours(0,0,0,0);
    var nowHour = moment().format('HH');
    var nowMinute = moment().format('mm');
    $('#appointment_time').datetimepicker({
        format: 'HH:mm',
        // defaultDate: dateNow,
        // minDate: moment({
        //     h: nowHour,
        //     minute: nowMinute
        // }),
        // maxDate: moment({h:24}),
    });

    const today = new Date();
    const yesterday = new Date(today);

    yesterday.setDate(yesterday.getDate() - 1);

    $('#appointment_date').datetimepicker({
        format: 'DD-MM-YYYY',
        // defaultDate: moment(),
        // defaultDate: dateNow,
        minDate: dateNow,
        // maxDate: moment({h:24}),
    });

    // confirm contact info
    $(document).on('input change', '#first_name', function() {
        $('#fname-confirm-text').text($(this).val());
    });
    $(document).on('input change', '#last_name', function() {
        $('#lname-confirm-text').text($(this).val());
    });
    $(document).on('input change', '#email', function() {
        if($(this).val() !== ''){
            $('.email-row').removeClass('d-none');
        }else{
            $('.email-row').addClass('d-none');
        }
        $('#email-confirm-text').text($(this).val());
    });
    $(document).on('input change', '#phone', function() {
        $('#phone-confirm-text').text($(this).val());
    });
    
    // confirm resrevation info
    $("#appointment_date").on("change.datetimepicker", ({e, oldDate}) => {    
        $('#date-confirm-text').text($('[name="appointment_date"]').val());
    });
    
    $("#appointment_time").on("change.datetimepicker", ({e, oldDate}) => {    
        $('#time-confirm-text').text($('[name="appointment_time"]').val());
    });

    $(document).on('input change', '#adults', function() {
        if($(this).val() !== ''){
            $('#adults-confirm-text').text($(this).val());
        }else{
            $('#adults-confirm-text').text('-');
        }
    });
    $(document).on('input change', '#kids', function() {
        if($(this).val() !== ''){
            $('#kids-confirm-text').text($(this).val());
        }else{
            $('#kids-confirm-text').text('-');
        }
    });
    $(document).on('input change', '#number_of_people', function() {
        $('#total-people-confirm-text').text($(this).val());
    });

    // total people calculation
    $("#adults,#kids").on('input change',function(){
        var totalPeople = null;
        
        var adults = $('#adults').val();
        var kids = $('#kids').val();

        if(adults !== '' && kids !== '') {
            totalPeople = parseInt(adults) + parseInt(kids);
        }else if(adults !== '' && kids === ''){
            totalPeople = adults;
        }else if(adults === '' && kids !== ''){
            totalPeople = kids;
        }

        $('#number_of_people').val(totalPeople);
        $('#total-people-confirm-text').text(totalPeople);
    });

    jQuery.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    }, $.validator.format("@lang('Please enter a valid phone number.')"));

    var submitform = true;
    var reservationTimeCheckUrl = '{{ route("reservation.reservation-time-check", ":slug") }}';
    reservationTimeCheckUrl = reservationTimeCheckUrl.replace(':slug', "{{$restaurant->slug}}");
    var form = $("#visitorForm");
    form.validate({
        normalizer: function(value) {
            return $.trim(value);
        },
        // ignore: [],
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
            appointment_date:{
                required: true,
                // remote: {
                //     type:'post',
                //     url:reservationTimeCheckUrl,
                //     headers: {
                //         'X-CSRF-TOKEN': "{{ csrf_token() }}",
                //     },
                //     data: {
                //         'appointment_date': function(){return $('#reservation-date-input').val()},
                //         'appointment_time': function(){return $('#reservation-time-input').val()},
                //         'is_date':true
                //     },
                // }
            },
            appointment_time:{
                required: true,
                // remote: {
                //     type:'post',
                //     url:reservationTimeCheckUrl,
                //     headers: {
                //         'X-CSRF-TOKEN': "{{ csrf_token() }}",
                //     },
                //     data: {
                //         'appointment_date': function(){return $('#reservation-date-input').val()},
                //         'appointment_time': function(){return $('#reservation-time-input').val()},
                //         'is_date':false
                //     },
                //     // dataType: 'json',
                // }
            },
            adults:{
                required: "#kids:blank",
                digits: true
            },
            kids:{
                required: "#adults:blank",
                digits: true
            },
            number_of_people: {
                required: true,
                digits: true
            },
            phone: {
                required: true,
                number: true,
                digits: true,
                exactlength: 10
            },
            is_terms_checked:{
                required: true,
            },
            have_covid:{
                required: true,
            }
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
            appointment_time:{
                required: "@lang('This field is required.')",
                // remote: "@lang('Please select another date or time.')"
            },
            appointment_date:{
                required: "@lang('This field is required.')",
                // remote: "@lang('Please select another date or time.')"
            },
            number_of_people: {
                required: "@lang('This field is required.')",
                digits: "@lang('Please enter only digits.')"
            },
            adults:{
                required: "@lang('This field is required.')",
                digits: "@lang('Please enter only digits.')"
            },
            kids:{
                required: "@lang('This field is required.')",
                digits: "@lang('Please enter only digits.')"
            },
            phone: {
                required: "@lang('This field is required.')",
                number: "@lang('Please enter a valid phone number.')",
                digits: "@lang('Please enter only digits.')"
            },
            is_terms_checked:{
                required: "@lang('Please accept terms of service.')",
            },
            have_covid: {
                required: "@lang('This field is required.')",
            }
        },
        errorPlacement: function(error, element) {
			if (element.attr("name") == "is_terms_checked" || element.attr("name") == "have_covid") {
				error.insertAfter($(element).closest('.checkbox'));
			}else if(element.attr("name") == "appointment_date" || element.attr("name") == "appointment_time" || element.attr("name") == "phone"){
                error.insertAfter($(element).closest('.input-group'));
            } else {
				error.insertAfter(element);
			}
		},
        submitHandler: function() {
            if(submitform){
                registerVisitor();
            }
        },
    });

    function registerVisitor() {
        var visitorFormData = $('#visitorForm').serialize();

        var url = '{{ route("reservation.reservation-save", ":slug") }}';
        url = url.replace(':slug', "{{$restaurant->slug}}");

        $.ajax({
            url: url,
            method: 'POST',
            data: visitorFormData,
            processData: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('.visitor-submit-btn').prop("disabled", true);
                $('.visitor-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> @lang('Loading')...`);
                submitform = false;
            },
            success: function(data, status, xhr) {
                fnToastSuccess(data.message);
                // form.resetForm();
                $('#visitorForm').trigger("reset");
                $('#visitorForm').find('.error').removeClass('error');
                setTimeout(function(){
                    location.reload();
                },2000);
            },
            error: function(xhr, status, error) {
                if (xhr.status == 422) {
                    var errorObj = Object.values(xhr.responseJSON.errors)
                    for (var key in errorObj) {
                        var value = errorObj[key];
                        fnToastError(value.pop());
                    }
                } else {
                    ajaxError(xhr, status, error);
                }
                submitform = true;
            },
            complete: function() {
                $('.visitor-submit-btn').attr("disabled", false);
                $('.visitor-submit-btn').html(`@lang('Save')`);
            }
        });
    }
</script>
@endpush