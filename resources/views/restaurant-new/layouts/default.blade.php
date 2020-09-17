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

        Echo.private(`reservation.${restaurantId}`).listen("ReservationEvent", e => {
            // console.log(e);
            notificationSound.play();
            // $('.notification-indicator').removeClass('d-none');
            var message = `${e.first_name} ${e.last_name} made reservation for ${e.number_of_people} ${e.number_of_people == 1 ? "person":'persons'} for date: ${e.appointment_date}.`;
             
            fnShowSuccessNotif(message);
        });
    </script>

</body>

</html>