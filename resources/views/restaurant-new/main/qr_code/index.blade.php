@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? $module_name : '')

@section('content')

<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card fancy-qr-main-block">

            <div class="qr-block">
                <h3 class="mb-2">@lang('Menu')</h3>
                <img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}"
                    alt="Qr code for menu" class="rm-qr-img-large">
            </div>
            <div class="phones-block">
                <div class="image-steps-block">
                    <img class="phone-img" src="{{ asset('restaurant-new/images/Scan_qr_code_phone.png') }}"
                        alt="Scan Qr Code">
                    <div class="phones-text mt-3 text-center">
                        <div>
                            <img src="{{ asset('restaurant-new/images/littledot1.png') }}" alt="step 1"
                                class="step-img">
                        </div>
                        <div>
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                        </div>
                    </div>
                </div>
                <div class="image-steps-block">
                    <img class="phone-img" src="{{ asset('restaurant-new/images/validate_qr_code_phone.png') }}"
                        alt="Validate QR Code" class="step-img">
                    <div class="phones-text mt-3 text-center">
                        <div>
                            <img src="{{ asset('restaurant-new/images/littledot2.png') }}" alt="step 1"
                                class="step-img">
                        </div>
                        <div>
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                        </div>
                    </div>
                </div>
                <div class="image-steps-block">
                    <img class="phone-img" src="{{ asset('restaurant-new/images/select_language_qr_code_phone.png') }}"
                        alt="Select Language" class="step-img">
                    <div class="phones-text mt-3 text-center">
                        <div>
                            <img src="{{ asset('restaurant-new/images/littledot3.png') }}" alt="step 1"
                                class="step-img">
                        </div>
                        <div>
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                            Scan the qr-code <br />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3 grid-margin d-flex flex-column">
        <div class="row">
            <div class="col-12 grid-margin stretch-card flex-start-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <a href="">
                                <div class="qr-right-card">@lang('Print your own stickers')</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card flex-start-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <a href="">
                                <div class="qr-right-card">@lang('Print your own stickers')</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card flex-start-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <a href="">
                                <div class="qr-right-card">@lang('Download on your computer')</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}"
                    alt="Qr code for menu" class="rm-qr-img-medium">
            </div>
        </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">@lang('Informational notice')</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="rm-info-notice">
                    @lang("Always make sure to test your QR-code on this screen. You can simply scan QR-code with your
                    smartphone. If it doesn't work, do not hesitate to file an incident on") <a
                        href='mailto:{{config('restomenu.constants.support_email')}}'
                        target='_top'>{{config('restomenu.constants.support_email')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush