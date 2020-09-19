<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ asset('restaurant-new/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('restaurant-new/images/favicon.png') }}" type="image/x-icon">

    <title>{{ config('app.name','Restomenu') }} | @yield('title')</title>

    @include('restaurant-new.layouts.includes.cssfiles')
    @stack('stylesheets')

</head>

<body>
    <div class="main-wrapper" id="app">
        @include('restaurant-new.layouts.includes.sidebar')
        <div class="page-wrapper">
            @include('restaurant-new.layouts.includes.header')
            <div class="page-content">
                @yield('content')

                <!--Reservation status change modal -->
                <div class="modal fade" id="notifResStatusModal" role="dialog" aria-labelledby="feedbackModalTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    @lang('Change Reservation Status')
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="javascript:void(0);" method="post" id="customerStatusForm">
                                <div class="modal-body p-4">
                                    <div class="form-group row">
                                        {{-- <div class="col-12 col-sm-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="panding_btn"
                                        value="0">
                                    @lang('Pending')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div> --}}
                                        <div class="col-12 col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                        id="accept_btn" value="1">
                                                    @lang('Accept')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                        id="reject_btn" value="-1">
                                                    @lang('Cancel')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                        id="schedule_btn" value="2">
                                                    @lang('Schedule')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row appointment_cancel_block d-none">

                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                {{-- <label class="form-check-label"> --}}
                                                <textarea rows="8" class="form-control" name="reservation_cancel_desc"
                                                    id="reservation_cancel_desc"></textarea>

                                                {{-- <i class="input-frame"></i></label> --}}
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason" id="full_today_btn" value="1">
                                                    @lang('Full today')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason" id="full_on_given_day_btn"
                                                        value="2">
                                                    @lang('Full on given day')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason"
                                                        id="exceptionally_closed_today_btn" value="3">
                                                    @lang('Exceptionally Closed today')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason"
                                                        id="exceptionally_closed_on_given_day_btn" value="4">
                                                    @lang('Exceptionally Closed on
                                                    given day')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason" id="propose_other_time_btn"
                                                        value="5">
                                                    @lang('Propose other time')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="reservation_cancel_reason" id="others_btn" value="6">
                                                    @lang('Others')
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row appointment_time_block d-none">
                                        <label for="appointment_time">@lang('Appointment Time')</label>
                                        <input type="text" class="form-control" name="appointment_time"
                                            id="appointment_time" />
                                    </div>

                                    <input type="hidden" class="form-control" name="visitor_id" id="visitor_id">
                                </div>
                                <div class="modal-footer feedback-modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">@lang('Close')</button>
                                    <button type="button"
                                        class="btn btn-primary shadow-none btn-restomenu-primary status-submit-btn">@lang('Save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @include('restaurant-new.layouts.includes.footer')
        </div>
    </div>

    @include('restaurant-new.layouts.includes.jsfiles')
    @stack('scripts')
    <script>
        var restaurantId = "{{auth()->guard('restaurant')->user()->id}}";

        var notificationSoundUrl = "{{asset('restaurant-new/sounds/notify.mp3')}}";
                
        var notificationSound = new Howl({
          src: [notificationSoundUrl]
        });

        Echo.private(`reservation.${restaurantId}`).listen("ReservationEvent", e => {
            // console.log(e);
            notificationSound.play();

            var message = `${e.first_name} ${e.last_name} made reservation for ${e.number_of_people} ${e.number_of_people == 1 ? "person":'persons'} for date ${e.appointment_date} ${e.appointment_time}.`;

            var reservationPageUrl = "{{route('restaurant.reservations.index')}}";

            var userIconSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>`;

            var notificationHtml = `<div class="notification-${e.notification_id}"><a href="${reservationPageUrl}" class="dropdown-item"><div class="icon">${userIconSvg}</div><div class="content"><p>${message}</p></div></a></div>`;

            $('.notification-indicator').removeClass('d-none');
            $('.notifications-list').prepend(notificationHtml); 

            var notificationCount = parseInt($('#notification-count').text());
            notificationCount = notificationCount + 1;
            $('#notification-count').text(notificationCount);

            if (!$(".no-notification-section").hasClass('d-none')) {
                $('.no-notification-section').addClass('d-none');
            }

            if (typeof socketEvent_NewReservationNotification === "function") {
                socketEvent_NewReservationNotification();
            }
            
            var notificationData = {
                firstName: e.first_name,
                lastName: e.last_name,
                numberOfPeople: e.number_of_people,
                appointmentDate: e.appointment_date,
                appointmentTime : e.appointment_time,
                restaurantName : "{{auth()->guard('restaurant')->user()->name}}",
                restaurantPhone: "{{auth()->guard('restaurant')->user()->phone}}",
                locale: e.locale,
                reservationId: e.reservationData.id
            };
             
            fnShowSuccessNotif(message, notificationData);
        });
    </script>

</body>

</html>