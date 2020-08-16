<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <title>{{ config('app.name','Restomenu') }}</title>
    <meta charset="UTF-8" />

    <link rel="shortcut icon" type="image/x-icon"
        href="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    @include('front.menu.layouts.includes.cssfiles')
    @stack('stylesheets')
    <script>
        var primaryColor = '{{$restaurant->setting->menu_primary_color}}';
        document.documentElement.style.setProperty('--primary-color', primaryColor);
    </script>
    {{-- <script src="{{ asset('front/menu/js/menu.js') }}"></script> --}}
</head>

<body>
    <p class="alert"></p>

    <!-- <div class="transparent-cover-view-menu" id="backdrop"></div> -->
    <!-- <div class="cover-enhanced" id="backdrop-enhanced"></div> -->
    <!-- <p class="close-image-instructions">X</p> -->
    <div class="mobile-preview-full">
        <div class="menu-container-enhanced">

            @include('front.menu.layouts.includes.header')

            @yield('content')

        </div>

    </div>

    <!-- select language button -->
    @if($restaurant->setting->language_english + $restaurant->setting->language_dutch +
    $restaurant->setting->language_french > 1)
    <div class="back-refer" id="back-button">
        <a href="{{route('select-language',['slug' => $restaurant->slug])}}">
            <img class="back-button-collection" src="{{asset('front/menu/images/back_button.svg')}}" />
            @if (Route::currentRouteName() == 'menu-nl')
            Kies een&nbsp;<strong>taal</strong>
            @elseif(Route::currentRouteName() == 'menu-fr')
            Choisissez une&nbsp;<strong>langue</strong>
            @elseif(Route::currentRouteName() == 'menu-en')
            Pick a&nbsp;<strong>language</strong>
            @endif
        </a>
    </div>
    @endif

    <!-- Footer -->
    @include('front.menu.layouts.includes.footer')

    @include('front.menu.layouts.includes.jsfiles')
    @stack("scripts")

</body>

</html>