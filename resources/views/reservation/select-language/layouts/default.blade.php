<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <title>{{ config('app.name','Restomenu') }}</title>
    <meta charset="UTF-8" />

    <link rel="shortcut icon" type="image/x-icon"
        href="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('front.menu.layouts.includes.cssfiles')
    @stack('stylesheets')
    <script>
        var primaryColor = '{{$restaurant->setting->menu_primary_color}}';
        document.documentElement.style.setProperty('--primary-color', primaryColor);
    </script>
    {{-- <script src="{{ asset('front/menu/js/menu.js') }}"></script> --}}

</head>

<body>
    <div class="language-selection-box-mobile">
        @include('front.select-language.layouts.includes.header')

        @yield('content')
    </div>

    <!-- Footer -->
    @include('front.select-language.layouts.includes.footer')
    @include('front.menu.layouts.includes.jsfiles')
    @stack('scripts')

</body>

</html>