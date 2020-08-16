@extends('restaurant-new.layouts.default')

@section('title', __($module_name). ' | Edit')

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{$module_route}}">{{ isset($module_name) ? __($module_name) : '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><strong>{{__('Edit')}}</strong></li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                @if(isset($module_name))
                <h5 class="mt-1">{{ $module_name }} {{__('Edit')}}</h5>
                @endif
            </div>
            {!! Form::model($result, array('url' => $module_route.'/'.$result->id, 'method' => 'PUT',
                "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'form_validate',
                'autocomplete'=>'off')) !!}
                <div class="card-body">

                @include("$moduleView._form")

                {{-- <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="tr-btn-set">
                            <a href="{{ $module_route }}" class="btn btn-light mr-2">{{__('Cancel')}}</a>
                            <button class="btn btn-primary " id="submit_form_button"
                                type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </div> --}}
                {!! Form::close() !!}
                @yield('additional-content')
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