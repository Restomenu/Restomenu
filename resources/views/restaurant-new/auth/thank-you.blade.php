@extends('restaurant-new.layouts.auth')

@section('title','Thank You')

@section('content')

<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-11 col-xl-10 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-lg-4 pr-lg-0">
                        <div class="auth-left-wrapper"
                            style="background-image: url({{ url('restaurant-new/images/food_219x452.jpg') }})">
                        </div>
                    </div>
                    <div class="col-lg-8 pl-lg-0 thank-you-wrapper">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Resto<span>Menu</span></a>

                            <div class="card-body wizard clearfix" role="application" id="steps-uid-0">
                                <div class="steps clearfix">
                                    <ul role="tablist">
                                        <li role="tab" aria-disabled="false" class="first" aria-selected="true"><a
                                                id="steps-uid-0-t-0" href="javascript:;"
                                                aria-controls="steps-uid-0-p-0"><span
                                                    class="current-info audible">current
                                                    step: </span><span class="number">1.</span> Registration</a></li>
                                        <li role="tab" aria-disabled="false"><a id="steps-uid-0-t-1" href="javascript:;"
                                                aria-controls="steps-uid-0-p-1"><span class="number">2.</span>
                                                Billing</a>
                                        </li>
                                        <li role="tab" aria-disabled="false" class="last current"><a
                                                id="steps-uid-0-t-2" href="javascript:;"
                                                aria-controls="steps-uid-0-p-2"><span class="number">3.</span>
                                                confirmation</a></li>
                                    </ul>
                                </div>
                                <div class="content clearfix">
                                    <h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">Registration</h3>

                                    <section class="px-0 body current thank-you-section" id="steps-uid-0-p-0"
                                        role="tabpanel" aria-labelledby="steps-uid-0-h-0" aria-hidden="false">

                                        <div class="thank-you-text-section">
                                            <h2 class="font-weight-normal mb-3 thank-you-heading">
                                                Thank You.
                                            </h2>
                                            <h4 class="text-muted font-weight-normal mb-3 thank-you-heading">
                                                You're all set. Your activation e-mail is underway.
                                            </h4>
                                            <div class="text-muted thank-you-description">
                                                You will recieve an activation e-mail to confirm your e-mail. Make sure
                                                to check your spammail, sometimes our mailmonkey tends to deliver it
                                                incorrectly.
                                            </div>
                                            <div class="mt-3">
                                                <a href="{{env('RESTOMENU_URL')}}" class="btn btn-outline-primary">Go to
                                                    homepage</a>
                                            </div>

                                        </div>

                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
</script>
@endpush