@extends('restaurant-new.layouts.auth')

@section('title','Register')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-10 col-xl-10 mx-auto">
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
                            <h5 class="text-muted font-weight-normal mb-4">
                                {{__('Let\'s get to know your restaurant a little better, that way we can optimize our platform to your needs.')}}
                            </h5>
                            <form class="forms-sample" role="form" method="POST"
                                action="{{ route('restaurant.register') }}" id="registerForm"
                                enctype="multipart/form-data">

                                <div class="card-body">

                                    @csrf

                                    <h3>{{__('Registration')}}</h3>

                                    <section>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">{{__('Restaurant name')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('name') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant name')}}" name="name" autofocus
                                                        autocomplete="name" value="{{ old('name') }}">

                                                    @error('name')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="phone">{{__('Restaurant contact number')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('phone') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant contact number')}}" name="phone"
                                                        autofocus autocomplete="phone" value="{{ old('phone') }}">

                                                    @error('phone')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">{{__('Restaurant email')}}</label>
                                                    <input type="email"
                                                        class="form-control  @error('email') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant email')}}" name="email" autofocus
                                                        autocomplete="email" value="{{ old('email') }}">

                                                    @error('email')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="slug">{{__('Restaurant website')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('slug') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant website')}}" name="slug" autofocus
                                                        autocomplete="slug" value="{{ old('slug') }}">

                                                    @error('slug')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="restaurant_type_id">{{__('Restaurant type')}}</label>

                                                    {{ Form::select('restaurant_type_id', [], null, ['id'=>'restaurant_type_id',"class"=>"form-control". ($errors->first('restaurant_type_id') ? ' is-invalid':''),"placeholder"=>__('Select Restaurant Type')]) }}

                                                    @error('restaurant_type_id')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label
                                                        for="amount_of_employees">{{__('Amount of employees')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('amount_of_employees') is-invalid @enderror"
                                                        placeholder="{{__('Amount of employees')}}"
                                                        name="amount_of_employees" autofocus
                                                        autocomplete="amount_of_employees"
                                                        value="{{ old('amount_of_employees') }}">

                                                    @error('amount_of_employees')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fb_url">{{__('Facebook link')}}</label>

                                                    <input type="text"
                                                        class="form-control  @error('fb_url') is-invalid @enderror"
                                                        placeholder="{{__('Facebook link')}}" name="fb_url" autofocus
                                                        autocomplete="fb_url" value="{{ old('fb_url') }}">

                                                    @error('fb_url')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="ig_url">{{__('Instagram link')}}</label>

                                                    <input type="text"
                                                        class="form-control  @error('ig_url') is-invalid @enderror"
                                                        placeholder="{{__('Instagram link')}}" name="ig_url" autofocus
                                                        autocomplete="ig_url" value="{{ old('ig_url') }}">

                                                    @error('ig_url')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="site_logo">{{__('Restaurant logo')}}</label>

                                                    <input type="file"
                                                        class="form-control @error('site_logo') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant logo')}}" name="site_logo"
                                                        autofocus autocomplete="ig_url" value="{{ old('site_logo') }}">

                                                    @error('site_logo')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </section>

                                    <h3>{{__('Billing')}}</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="street">{{__('Restaurant street')}}</label>

                                                    <input type="text"
                                                        class="form-control @error('street') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant street')}}" name="street"
                                                        autofocus autocomplete="street" value="{{ old('street') }}">

                                                    @error('street')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="house_number">{{__('Restaurant house number')}}</label>

                                                    <input type="text"
                                                        class="form-control @error('house_number') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant house number')}}"
                                                        name="house_number" autofocus autocomplete="house_number"
                                                        value="{{ old('house_number') }}">

                                                    @error('house_number')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="province">{{__('Restaurant province')}}</label>

                                                    <input type="text"
                                                        class="form-control @error('province') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant province')}}" name="province"
                                                        autofocus autocomplete="province" value="{{ old('province') }}">

                                                    @error('province')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="country">{{__('Restaurant country')}}</label>

                                                    <input type="text"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        placeholder="{{__('Restaurant country')}}" name="country"
                                                        autofocus autocomplete="country" value="{{ old('country') }}">

                                                    @error('country')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="VAT_number">{{__('VAT number')}}</label>

                                                    <input type="text"
                                                        class="form-control @error('VAT_number') is-invalid @enderror"
                                                        placeholder="{{__('VAT number')}}" name="VAT_number" autofocus
                                                        autocomplete="VAT_number" value="{{ old('VAT_number') }}">

                                                    @error('VAT_number')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <h3>{{__('confirmation')}}</h3>
                                    <section>
                                        <div>Confirm!</div>
                                    </section>

                                    {{-- <h3>{{__('Billing')}}</h3> --}}
                                    {{-- <div class="mt-3">
                                        <button type="submit"
                                            class="btn btn-primary mr-2 mb-2 mb-md-0">{{__('Register')}}</button>
                                    <a href="{{route('restaurant.login')}}"
                                        class="d-block mt-3 text-muted">{{__('Already a user?')}}
                                        {{__('Sign in')}}</a>
                                </div> --}}
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


@push("scripts")

<script>
    var form = $("#registerForm");
    form.validate({
        errorPlacement: function(error, element) {
            // if (element.attr("name") == "city_id") {
            //     error.insertAfter($(element).next());
            // } else {
            //     error.insertAfter(element);
            // }
            error.insertAfter(element);
        },
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        enableAllSteps: true,
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            // alert("Submitted!");
            form.submit();
        }
    });
</script>

@endpush