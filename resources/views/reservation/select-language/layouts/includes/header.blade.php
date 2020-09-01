<div class="language-selection-box-mobile-header">
    <img class="restaurant-logo-at-selection"
        src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />
</div>