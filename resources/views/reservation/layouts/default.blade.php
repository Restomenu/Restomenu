<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- #FAVICONS -->
    {{-- <link rel="shortcut icon" href="{{ asset('reservation/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('reservation/images/favicon.png') }}" type="image/x-icon"> --}}

    <link rel="shortcut icon" type="image/x-icon"
        href="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />

    <title>{{ config('app.name','Restomenu') }} | @yield('title')</title>

    <script>
        var primaryColor = '{{$restaurant->setting->menu_primary_color}}';
        document.documentElement.style.setProperty('--reservation-primary-color', primaryColor);
    </script>

    @include('reservation.layouts.includes.cssfiles')
    @stack('stylesheets')

</head>

<body>
    <div class="main-wrapper" id="app">
        @yield('content')

        @include('reservation.layouts.includes.footer')
    </div>

    @include('reservation.layouts.includes.jsfiles')
    @stack('scripts')

</body>

</html>