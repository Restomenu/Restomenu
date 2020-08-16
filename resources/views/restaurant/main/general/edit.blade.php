@extends('restaurant.layouts.default')

@section('title', __($module_name). ' | Edit')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ isset($module_name) ? $module_name : '' }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{$module_route}}">{{ isset($module_name) ? $module_name : '' }}</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{__('Edit')}}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    @if(isset($module_name))
                    <h5>{{ $module_name }} {{__('Edit')}}</h5>
                    @endif
                </div>
                <div class="ibox-content">
                    {!! Form::model($result, array('url' => $module_route.'/'.$result->id, 'method' => 'PUT',
                    "enctype"=>"multipart/form-data",'class'=>'form form-horizontal','id'=>'form_validate',
                    'autocomplete'=>'off')) !!}

                    @include("$moduleView._form")

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="tr-btn-set">
                                <a href="{{ $module_route }}" class="btn btn-info mr-2 btn-danger">{{__('Cancel')}}</a>
                                <button class="btn btn-primary " id="submit_form_button"
                                    type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    @yield('additional-content')
                </div>
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