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

        var notificationCount = parseInt("{{auth()->guard('restaurant')->user()->totalNotificationCount()}}");

        Echo.private(`reservation.${restaurantId}`).listen("ReservationEvent", e => {
            // console.log(e);
            notificationSound.play();

            var message = `${e.first_name} ${e.last_name} made reservation for ${e.number_of_people} ${e.number_of_people == 1 ? "person":'persons'} for date ${e.appointment_date} ${e.appointment_time}.`;

            var reservationPageUrl = "{{route('restaurant.reservations.index')}}";

            var userIconSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>`;

            var notificationHtml = `<div><a href="${reservationPageUrl}" class="dropdown-item"><div class="icon">${userIconSvg}</div><div class="content"><p>${message}</p></div></a></div>`;

            $('.notification-indicator').removeClass('d-none');
            $('.notifications-list').prepend(notificationHtml); 

            notificationCount = notificationCount + 1;

            $('#notification-count').text(notificationCount);

            if (!$(".no-notification-section").hasClass('d-none')) {
                $('.no-notification-section').addClass('d-none');
            }
             
            fnShowSuccessNotif(message);
        });
    </script>

</body>

</html>