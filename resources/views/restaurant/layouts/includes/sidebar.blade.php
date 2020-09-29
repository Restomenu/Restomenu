<?php

function setActiveMenu($route)
{
    return (Request::is($route) || Request::is($route . '/*')) ? 'active' : '';
}
?>

<!-- side navigation -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <!-- profile -->
            <li class="nav-header text-center">
                <div class="dropdown profile-element">
                    <img alt="image" width="100"
                        src="{{asset(config("restomenu.constants.site_logo_path").auth()->guard('restaurant')->user()->setting->site_logo)}}" />
                    <a href="javascript:void(0)">
                        <span class="block m-t-xs font-bold">{{ auth()->guard('restaurant')->user()->setting->site_name }}</span>
                        <!-- <span class="text-muted text-xs block">Admin<b class="caret"></b></span> -->
                    </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a class="dropdown-item" href="{{ route('restaurant.logout') }}"
                                onclick="event.preventDefault();          document.getElementById('logout-form2').submit();">
                                <i class="fa fa-sign-out"></i>
                                {{ __('Log out') }}
                            </a>

                            <form id="logout-form2" action="{{ route('restaurant.logout') }}" method="POST"
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
                <a href="{{route('restaurant.home')}}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">{{__('Dashboard')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("categories") }}">
                <a href="{{route('restaurant.categories.index')}}">
                    <i class="fa fa-list"></i>
                    <span class="nav-label">{{__('Categories')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("dishes") }}">
                <a href="{{route('restaurant.dishes.index')}}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">{{__('Dishes')}}</span>
                </a>
            </li>

            <li class="{{ setActiveMenu("combo-dishes") }}">
                <a href="{{route('restaurant.combo-dishes.index')}}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">{{__('Combo Dishes')}}</span>
                </a>
            </li>
            <li class="{{ setActiveMenu("users") }}">
                <a href="{{route('restaurant.users.index')}}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">{{__('Customers')}}</span>
                </a>
            </li>
            {{-- <li class="{{ setActiveMenu("category-icons") }}">
            <a href="{{route('restaurant.category-icons.index')}}">
                <i class="fa fa-list"></i>
                <span class="nav-label">{{__('Category Icons')}}</span>
            </a>
            </li> --}}

            <li class="{{ setActiveMenu("feedbacks") }}">
                <a href="{{route('restaurant.feedbacks.index')}}">
                    <i class="fa fa-comments" aria-hidden="true"></i>
                    <span class="nav-label">{{__('Feedbacks')}}</span>
                </a>
            </li>

            {{-- <li class="{{ setActiveMenu("settings") }}">
            <a href="{{route('restaurant.settings.index')}}">
                <i class="fa fa-wrench"></i>
                <span class="nav-label">{{__('Settings')}}</span>
            </a>
            </li> --}}

        </ul>
    </div>
</nav>
<!-- !side navigation -->