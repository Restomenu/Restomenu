@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? $module_name : '')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">{{isset($module_name) ? $module_name : ''}}</h4>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="ml-auto">
                            @if (auth()->guard('restaurant')->user()->setting->qr_code_menu)
                            <a href="{{ $module_route."/download" }}"
                                class="btn btn-sm btn-primary pull-right">{{__('Download')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}"
                        alt="Qr code for menu" class="rm-qr-img">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush