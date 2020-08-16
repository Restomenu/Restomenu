<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name','Restomenu') }} | @yield('title')</title>

    <!-- Styles -->
    @include('restaurant-new.layouts.includes.cssfiles')
    @stack('stylesheets')

</head>

<body>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    @include('restaurant-new.layouts.includes.jsfiles')
    @stack('scripts')
</body>

</html>