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
<div class="wrapper-container">
    <div class="wrapper">
        <form action="{{route('reservation.reservation-save',['slug' => $restaurant->slug])}}" method="post"
            id="visitorForm" class="reservation-form">
            <div id="wizard">
                <!-- SECTION 1 -->
                <h4></h4>
                <section>

                    @if($restaurant->restaurantTime && (($restaurant->restaurantTime->morning_start_time &&
                    $restaurant->restaurantTime->morning_end_time) || ($restaurant->restaurantTime->evening_start_time
                    && $restaurant->restaurantTime->evening_end_time)))
                    <div class="mb-2 text-center timing-text">
                        @if($restaurant->restaurantTime->morning_start_time &&
                        $restaurant->restaurantTime->morning_end_time)
                        <div>
                            @lang('Morning Time'): {{$restaurant->restaurantTime->morning_start_time}} @lang('To')
                            {{$restaurant->restaurantTime->morning_end_time}}
                        </div>
                        @endif

                        @if($restaurant->restaurantTime->evening_start_time &&
                        $restaurant->restaurantTime->evening_end_time)
                        <div>
                            @lang('Evening Time'): {{$restaurant->restaurantTime->evening_start_time}} @lang('To')
                            {{$restaurant->restaurantTime->evening_end_time}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="input-group date" id="appointment_time" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input rm-text-input shadow-none"
                                name="appointment_time" data-target="#appointment_time"
                                placeholder="@lang('Select Your Time')" />
                            <div class="input-group-append" data-target="#appointment_time"
                                data-toggle="datetimepicker">
                                <div class="input-group-text input-group-text-no-border"><i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people"
                            id="number_of_people" placeholder="@lang('Number of people')" min="1">
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
                        <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone"
                            placeholder="@lang('Phone number')">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_terms_checked" value="1"> <a
                                href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">@lang('I agree
                                to
                                the
                                terms of service.')</a>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_agreed" value="1">@lang('Agree with submitting your
                            information
                            to our customers record.')</a>
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
            {{-- <h4></h4>
        <section>
            <div class="product">
                <div class="item">
                    <div class="left">
                        <a href="#" class="thumb">
                            <img src="images/item-1.png" alt="">
                        </a>
                        <div class="purchase">
                            <h6>
                                <a href="#">Low Table/Stool</a>
                            </h6>
                            <span>x4</span>
                        </div>
                    </div>
                    <span class="price">$29</span>
                </div>
                <div class="item">
                    <div class="left">
                        <a href="#" class="thumb">
                            <img src="images/item-2.png" alt="">
                        </a>
                        <div class="purchase">
                            <h6>
                                <a href="#">Set of 3 Porcelain</a>
                            </h6>
                            <span>x2</span>
                        </div>
                    </div>
                    <span class="price">$124</span>
                </div>
            </div>
            <div class="checkout">
                <div class="subtotal">
                    <span class="heading">Subtotal</span>
                    <span>$364</span>
                </div>
                <p class="shipping">
                    <span class="heading">Shipping</span>
                    there are no shipping methods available. please double check your address, or contact us if you
                    need any help.
                </p>
                <div class="total">
                    <span class="heading">Subtotal</span>
                    <span class="total-price">$364</span>
                </div>
            </div>
        </section> --}}

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
@endsection

@push('scripts')
<script>
    $(".steps ul").attr('data-title','Book A Table');
    $(".steps ul").attr('data-title-2','Contact Information');

    var dateNow = new Date();
    var nowHour = moment().format('HH');
    var nowMinute = moment().format('mm');
    $('#appointment_time').datetimepicker({
        format: 'HH:mm',
        defaultDate: dateNow,
        minDate: moment({
            h: nowHour,
            minute: nowMinute
        }),
        maxDate: moment({h:24}),
    });

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
            number_of_people: {
                required: true,
            },
            phone: {
                required: true,
                number: true
            },
            is_terms_checked:{
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
            number_of_people: {
                required: "@lang('This field is required.')",
            },
            phone: {
                required: "@lang('This field is required.')",
                number: "@lang('Please enter a valid phone number.')",
            },
            is_terms_checked:{
                required: "@lang('Please accept terms of service.')",
            }
        },
        errorPlacement: function(error, element) {
			if (element.attr("name") == "is_terms_checked") {
				error.insertAfter($(element).closest('.checkbox'));
			} else {
				error.insertAfter(element);
			}
		},
        submitHandler: function() {
            registerVisitor();
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
            },
            success: function(data, status, xhr) {
                fnToastSuccess(data.message);
                setTimeout(function(){
                    location.reload();
                },1000);
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
            },
            complete: function() {
                $('.visitor-submit-btn').attr("disabled", false);
                $('.visitor-submit-btn').html(`@lang('Save')`);
            }
        });
    }
</script>
@endpush