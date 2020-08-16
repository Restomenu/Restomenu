@extends('restaurant-new.layouts.auth')

@section('title','500')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
      <img src="{{ url('errors/404.svg') }}" class="img-fluid mb-2" alt="404">
      <h1 class="font-weight-bold mb-22 mt-2 tx-80 text-muted">500</h1>
      <h4 class="mb-2">Internal server error</h4>
      <h6 class="text-muted mb-3 text-center">Oopps!! There wan an error. Please try agin later.</h6>
    </div>
  </div>

</div>
@endsection