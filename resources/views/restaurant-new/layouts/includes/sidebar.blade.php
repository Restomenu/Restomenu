<?php

function setActiveMenu($route)
{
    return (Request::is($route) || Request::is($route . '/*')) ? 'active' : '';
}
// function setShowMenu($route)
// {
//     return (Request::is($route) || Request::is($route . '/*')) ? 'show' : '';
// }

// function set_active($route)
// {
//     if (is_array($route)) {
//         return in_array(Request::path(), $route) ? 'active' : '';
//     }
//     return Request::path() == $route ? 'active' : '';
// }
// function set_show($route)
// {
//     if (is_array($route)) {
//         return in_array(Request::path(), $route) ? 'show' : '';
//     }
//     return Request::path() == $route ? 'show' : '';
// }

function active_class($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function is_active_route($path)
{
    return call_user_func_array('Request::is', (array) $path) ? 'true' : 'false';
}

function show_class($path)
{
    return call_user_func_array('Request::is', (array) $path) ? 'show' : '';
}
?>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand mt-1">
            {{env('APP_NAME','Restomenu')}}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item {{ setActiveMenu('home') }}">
                <a href="{{route('restaurant.home')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">{{__('Dashboard')}}</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ active_class(['dishes','dishes/*','categories','categories/*','combo-dishes','combo-dishes/*']) }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="smartphone"></i>
                    <span class="link-title">{{__('Digital Menu')}}</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['dishes','dishes/*','categories','categories/*','combo-dishes','combo-dishes/*']) }}" id="emails" style="">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('restaurant.dishes.index')}}" class="nav-link {{ active_class(['dishes','dishes/*']) }}">{{__('Dishes')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('restaurant.categories.index')}}" class="nav-link {{ active_class(['categories','categories/*']) }}">{{__('Categories')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('restaurant.combo-dishes.index')}}" class="nav-link {{ active_class(['combo-dishes','combo-dishes/*']) }}">{{__('Combo Dishes')}}</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="nav-item {{ setActiveMenu('categories') }}">
                <a href="{{route('restaurant.categories.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">{{__('Categories')}}</span>
                </a>
            </li>

            <li class="nav-item {{ setActiveMenu('dishes') }}">
                <a href="{{route('restaurant.dishes.index')}}" class="nav-link">
                    {{-- <i class="mdi mdi-food-fork-drink"></i> --}}
                    <i class="link-icon" data-feather="coffee"></i>
                    {{-- <i class="fa fa-cutlery" aria-hidden="true"></i> --}}
                    <span class="link-title">{{__('Dishes')}}</span>
                </a>
            </li>

            <li class="nav-item {{ setActiveMenu('combo-dishes') }}">
                <a href="{{route('restaurant.combo-dishes.index')}}" class="nav-link">
                    {{-- <i class="mdi mdi-food"></i> --}}
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">{{__('Combo Dishes')}}</span>
                </a>
            </li>

            <li class="nav-item {{ setActiveMenu('users') }}">
                <a href="{{route('restaurant.users.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">{{__('Users')}}</span>
                </a>
            </li>

            <li class="nav-item {{ setActiveMenu('feedbacks') }}">
                <a href="{{route('restaurant.feedbacks.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">{{__('Feedbacks')}}</span>
                </a>
            </li>

            <li class="nav-item {{ setActiveMenu('visitors') }}">
                <a href="{{route('restaurant.visitors.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">{{__('COVID-19 Registrations')}}</span>
                </a>
            </li>
            <li class="nav-item {{ setActiveMenu('reservations') }}">
                <a href="{{route('restaurant.reservations.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">{{__('Reservations')}}</span>
                </a>
            </li>
            <li class="nav-item {{ setActiveMenu('settings') }}">
                <a href="{{route('restaurant.settings-edit')}}" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">{{__('Settings')}}</span>
                </a>
            </li>
            <li class="nav-item {{ setActiveMenu('qr-code') }}">
                <a href="{{route('restaurant.qr-code.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">{{__('Qr Code')}}</span>
                </a>
            </li>
            <li class="nav-item {{ setActiveMenu('qr-code-order') }}">
                <a href="{{route('restaurant.qr-code-order.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="package"></i>
                    <span class="link-title">{{__('Qr Code Orders')}}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>