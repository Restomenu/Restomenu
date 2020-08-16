@extends('admin.layouts.default')

@section('title', __('Dashboard'))

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>@lang('Dashboard')</h2>
    </div>
</div>

<div class="container p-4">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h4>Login successful!</h4>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-primary">@lang('Active')</span>
                    </div>
                    <h4>@lang('Categories')</h4>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$dashboardData['totalCategories']}}</h1> --}}
        {{-- <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div> --}}
        {{-- <small>New orders</small> --}}
        {{-- </div>
            </div>
        </div> --}}
        {{-- <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-primary">@lang('Active')</span>
                    </div>
                    <h4>@lang('Dishes')</h4>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$dashboardData['totalDishes']}}</h1>
    </div>
</div>
</div>

<div class="col-lg-4">
    <div class="ibox ">
        <div class="ibox-title">
            <div class="ibox-tools">
                <span class="label label-primary">@lang('Active')</span>
            </div>
            <h4>@lang('Combo Dishes')</h4>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$dashboardData['totalComboDishes']}}</h1>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="ibox ">
        <div class="ibox-title">
            <div class="ibox-tools">
                <span class="label label-primary">@lang('Total')</span>
            </div>
            <h4>@lang('Customers')</h4>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$dashboardData['totalCustomers']}}</h1>
        </div>
    </div>
</div> --}}
</div>
</div>

@endsection