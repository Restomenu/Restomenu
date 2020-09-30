<?php

function setActiveMenu($route)
{
    return (Request::is($route) || Request::is($route . '/*')) ? 'active' : '';
}
//         $siteLogo = \App\Repositories\AppSettingsRepository::getSettings()['site_logo'];
//         $siteName = \App\Repositories\AppSettingsRepository::getSettings()['site_name'];
//         // dd($siteName )
?>

<!-- side navigation -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <!-- profile -->
            <li class="nav-header text-center">
                <div class="dropdown profile-element">
                    <img alt="image" width="100" src="{{asset("admin/images/Logo.png")}}" />
                    <a href="javascript:void(0)">
                        <span class="block m-t-xs font-bold">{{ Auth::guard('admin')->user()->name }}</span>
                        <!-- <span class="text-muted text-xs block">Admin<b class="caret"></b></span> -->
                    </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin-logout') }}"
                                onclick="event.preventDefault();          document.getElementById('logout-form2').submit();">
                                <i class="fa fa-sign-out"></i>
                                {{ __('Log out') }}
                            </a>

                            <form id="logout-form2" action="{{ route('admin-logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
                <div class="logo-element">
                    RM
                </div>
            </li>
            <!-- !profile -->

            <li class="{{ setActiveMenu("home") }}">
                <a href="{{route('admin-home')}}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">{{__('Dashboard')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("restaurants") }}">
                <a href="{{route('restaurants.index')}}">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Restaurants')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("category-icons") }}">
                <a href="{{route('category-icons.index')}}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Category Icons')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("allergens") }}">
                <a href="{{route('allergens.index')}}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Allergens')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("visitors") }}">
                <a href="{{route('visitors.index')}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Customers')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("restaurant-feedbacks") }}">
                <a href="{{route('restaurant-feedbacks.index')}}">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Restaurant Feedbacks')}}</span>
                </a>
            </li>
            <!-- <li class="{{ setActiveMenu("restaurant-feedbacks") }}">
                <a href="{{route('translation.index')}}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Restaurant Translations')}}</span>
                </a>
            </li> -->
            <li class="{{ setActiveMenu("restaurant-types") }}">
                <a href="{{route('restaurant-types.index')}}">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Restaurant Types')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("cities") }}">
                <a href="{{route('cities.index')}}">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Cities')}}</span>
                </a>
            </li>

            
            {{-- <li class="{{ setActiveMenu("categories") }}">
            <a href="{{route('categories.index')}}">
                <i class="fa fa-list"></i>
                <span class="nav-label">{{__('Categories')}}</span>
            </a>
            </li>

            <li class="{{ setActiveMenu("dishes") }}">
                <a href="{{route('dishes.index')}}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">{{__('Dishes')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("combo-dishes") }}">
                <a href="{{route('combo-dishes.index')}}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">{{__('Combo Dishes')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("users") }}">
                <a href="{{route('users.index')}}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">{{__('Customers')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("feedbacks") }}">
                <a href="{{route('feedbacks.index')}}">
                    <i class="fa fa-comments" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Feedbacks')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("settings") }}">
                <a href="{{route('settings.index')}}">
                    <i class="fa fa-wrench"></i>
                    <span class="nav-label">{{__('Settings')}}</span>
                </a>
            </li> --}}

        </ul>
    </div>
</nav>
<!-- !side navigation -->