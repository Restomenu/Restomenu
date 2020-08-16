@extends('restaurant-new.layouts.default')

@section('title', __($module_name). ' | Add')

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{$module_route}}">{{ isset($module_name) ? __($module_name) : '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><strong>{{__('Add')}}</strong></li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h5 class="mt-1">{{ isset($module_name) ? __($module_name) : '' }} {{__('Add')}}</h5>
            </div>
            {!! Form::open(['url' => $module_route, 'method' => 'POST',
            "enctype"=>"multipart/form-data",'class'=>'form-horizontal','id'=>'form_validate','name'=>'form_general',
            'autocomplete'=>'off']) !!}
            <div class="card-body">
               
                
                @include("$moduleView._form")
                {{-- <h3>Finish</h3>
                <section>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="tr-btn-set">
                            <a href="{{ $module_route }}" class="btn mr-2 btn btn-light">{{__('Cancel')}}</a>
                            <button class="btn btn-primary " id="submit_form_button"
                                type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
            </section> --}}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")

<script>
    
    $(document).ready(function() {
        // $('.i-checks').iCheck({
        //     checkboxClass: 'icheckbox_square-green',
        //     radioClass: 'iradio_square-green',
        // });


    });
</script>
@endpush