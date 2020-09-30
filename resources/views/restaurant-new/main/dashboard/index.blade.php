@extends('restaurant-new.layouts.default')

@section('title', __('Dashboard'))

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0"><span id="greeting"></span>
            {{__('You have :numberOfCustomers reservations today.',['numberOfCustomers'=>$dashboardData['totalCustomers']])}}
        </h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0 refresh-btn">
            <i class="btn-icon-prepend" data-feather="refresh-ccw"></i>
            {{__('Refresh')}}
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Categories')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.categories.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['totalCategories']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Active')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Dishes')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.dishes.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['totalDishes']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Active')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Combo Dishes')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.combo-dishes.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['totalComboDishes']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Active')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Users')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.users.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['totalUsers']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Total')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Customers')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.visitors.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['totalCustomers']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Total')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">@lang('Checked Out Customers')</h6>
                            <div class="dropdown mb-2">
                                <a href="{{route('restaurant.visitors.index')}}" class="btn p-0">
                                    <i data-feather="eye" class="icon-md"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2">{{$dashboardData['checkedOutCustomers']}}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>@lang('Total')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> <!-- row -->

@endsection

@push('scripts')
<script>

    $('.refresh-btn').on('click',function () {
        location.reload();
    });

    var currentHour = new Date().getHours();
    if (currentHour >= 4 && currentHour < 12) {
        $('#greeting').text('@lang("Good Morning,")');
    } else if (currentHour >= 12 && currentHour < 17) {
        $('#greeting').text('@lang("Good Afternoon,")');
    } else if (currentHour >= 17 && currentHour < 22) {
        $('#greeting').text('@lang("Good Evening,")');
    } else {
        $('#greeting').text('@lang("Good Night,")');
    }

</script>
@endpush