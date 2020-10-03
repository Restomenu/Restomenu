<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{auth()->guard('restaurant')->user()->setting->site_name}}</title>
    <link rel="stylesheet" href="{{ url('restaurant-new/css/qr_banner.css') }}" />
</head>

<body>

    <div class="pdf-wrapper" style="padding:1px 0 0 0; z-index: 1;">
    <!-- <div class="pdf-wrapper" style="padding:30px 0 0 0; z-index: 1;"> -->
        <div class="print-qr-banner-block" style="width: 67%;">
        <!-- <div class="print-qr-banner-block" style="width: 70%;padding-top:-39px;"> -->

            @if (auth()->guard('restaurant')->user()->setting->site_logo)
            <span style="">
                <img src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath(auth()->guard('restaurant')->user()->id).auth()->guard('restaurant')->user()->setting->site_logo)}}" alt="" class="logo" style="max-width: 120px;max-height: 120px;background-color:white;background-size: 0 0; margin-top:-10px">
            </span>
            @endif

            <h2 class="main-title">DIGITAL MENU</h2>
            <div class="qr-img-block">
                <img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" class="qr-main-image" style="max-width: 155px;">
            </div>

            <div class="scan-me-1">SCAN MIJ</div>
            <div class="scan-me-2">SCANNEZ-MOI</div>
            <div class="scan-me-3">SCAN ME</div>

            <div class="link-block">
                <div class="not-work-text">
                    werkt het niet? ca fonctionne pas? Doesn't work?
                </div>
                <div class="menu-link-block" style="font-weight:bold;">
                    <a href="{{config('restomenu.urls.restaurant_menu_base_url').auth()->guard('restaurant')->user()->slug}}" style="color:black;text-decoration:none">{{config('restomenu.urls.restaurant_menu_base_url').auth()->guard('restaurant')->user()->slug}}</a>

                    <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis quasi quisquam  -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>