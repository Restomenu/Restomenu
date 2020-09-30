@extends('restaurant-new.layouts.auth')

@section('title','Login')

@section('content')

<div class="languageDropdownBlock mt-2">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (app()->getLocale() == 'en')
                <i class="flag-icon flag-icon-us mt-1" title="us"></i>

                @elseif (app()->getLocale() == 'fr')
                <i class="flag-icon flag-icon-fr" title="fr"></i>

                @elseif (app()->getLocale() == 'nl')
                <i class="flag-icon flag-icon-be" title="nl"></i>
                @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="languageDropdown">

                <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-nl">
                    <i class="flag-icon flag-icon-be" title="us"></i>
                </a>

                <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-fr">
                    <i class="flag-icon flag-icon-fr" title="us"></i>
                </a>

                <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-en">
                    <i class="flag-icon flag-icon-us" title="us"></i>
                </a>

            </div>
        </li>

    </ul>
</div>

<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pr-md-0">
                        <div class="auth-left-wrapper"
                            style="background-image: url({{ url('restaurant-new/images/food_219x452.jpg') }})">
                        </div>
                    </div>
                    <div class="col-md-8 pl-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Resto<span>Menu</span></a>
                            <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                            <form class="forms-sample" role="form" method="POST"
                                action="{{ route('restaurant.login') }}" id="loginForm">

                                @csrf

                                <div class="form-group">
                                    <label for="email">{{__('Email address')}}</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        placeholder="Email" name="email" autofocus autocomplete="email"
                                        value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">{{__('Password')}}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password">

                                    @error('password')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        {{__('Remember me')}}
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-primary mr-2 mb-2 mb-md-0">{{__('Login')}}</button>
                                    <a href="{{route('restaurant.register')}}"
                                        class="btn btn-outline-primary mr-2 mb-2 mb-md-0">{{__('Sign up')}}</a>
                                    <br>
                                    <div class="mt-2">
                                        <a href="{{ route('restaurant.password-reset-form') }}"><small>{{__('Forgot
                                            password?')}}</small></a>
                                    </div>

                                    {{-- <a href="{{route('restaurant.register')}}"
                                    class="d-block mt-3 text-muted">{{__('Not a user?')}} {{__('Sign up')}}</a> --}}
                                </div>
                            </form>
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
    $("#lang-btn-en").click(function() {
        window.location = "{{ route('restaurant.auth.lang',['locale' => 'en']) }}";
    });
    $("#lang-btn-nl").click(function() {
        window.location = "{{ route('restaurant.auth.lang',['locale' => 'nl']) }}";
    });
    $("#lang-btn-fr").click(function() {
        window.location = "{{ route('restaurant.auth.lang',['locale' => 'fr']) }}";
    });
</script>
@endpush