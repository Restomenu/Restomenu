@extends('restaurant.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@push("stylesheets")
<style>
    #category_list li.ui-state-highlight {
        padding: 24px;
        background-color: #ffffcc;
        border: 1px dotted #ccc;
        cursor: move;
        margin-top: 12px;
    }

    #category_list li {
        font-size: 14px;
        font-weight: 600;
        z-index: 1;
        margin-bottom: 10px;
        padding: 13px;
        background-color: white;
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-left: 4px solid #1aaa8d;
    }
</style>
@endpush

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ isset($module_name) ? __($module_name) : '' }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{$module_route}}">{{ isset($module_name) ? __($module_name) : '' }}</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{__('Sorting')}}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{ isset($module_name) ? __(Str::plural($module_name)) : '' }}</h3>
                    <div class="pull-right">
                        <a href="{{ $module_route }}" class="btn btn-xs btn-primary mr-2">{{__('Back')}}</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <ul class="list-unstyled" id="category_list">
                        @foreach($result as $category)
                        <li id="{{$category->id}}">{{$category->name}}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="page_order_list" id="page_order_list" />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $("#category_list").sortable({
            placeholder: "ui-state-highlight",
            update: function(event, ui) {
                var category_id_array = [];
                $('#category_list li').each(function() {
                    category_id_array.push($(this).attr("id"));
                });
                $.ajax({
                    url: "{{route('restaurant.categories-sorting-update')}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        category_id_array: category_id_array
                    },
                    success: function(data) {
                        fnToastSuccess(data.message);
                    },
                    error: function(xhr, status, error) {
                        ajaxError(xhr, status, error);
                    }
                });
            }
        });

    });
</script>
@endpush