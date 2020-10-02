<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR code</title>
    <link rel="stylesheet" href="{{ url('restaurant-new/css/qr_banner.css') }}" />
</head>
<body>
    
</body>
</html>

<div class="print-qr-banner-block">    

    @if (auth()->guard('restaurant')->user()->setting->site_logo)
    <img src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath(auth()->guard('restaurant')->user()->id).auth()->guard('restaurant')->user()->setting->site_logo)}}" alt="" class="logo">   
    @endif
     
    <h1 class="main-title">DIGITAL MENU</h1>
    <div class="qr-img-block">
        <img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" class="qr-main-image">
    </div>

    <div class="scan-me-1">SCAN MIJ</div>
    <div class="scan-me-2">SCANNEZ-MOI</div>
    <div class="scan-me-3">SCAN ME</div>

    <div class="link-block">
        <div class="not-work-text">
            werkt het niet? ca fonctionne pas? Doesn't work?
        </div>
        <div class="menu-link-block">
            {{config('restomenu.urls.restaurant_menu_base_url').auth()->guard('restaurant')->user()->slug}}
        </div>
    </div>
</div>