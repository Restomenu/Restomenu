<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name','Restomenu') }} | @yield('title')</title>

    @include('restaurant.layouts.includes.cssfiles')
    @stack('stylesheets')

</head>

<body>
    <div id="wrapper">

        @include('restaurant.layouts.includes.sidebar')

        <!-- main page -->
        <div id="page-wrapper" class="gray-bg dashbard-1">

            @include('restaurant.layouts.includes.header')

            <!-- @yield('headerbreadcrumbs') -->

            @yield('content')

            @include('restaurant.layouts.includes.footer')

        </div>
        <!-- !main page -->

    </div>

    @include('restaurant.layouts.includes.jsfiles')
    @stack('scripts')

</body>

</html>