@extends('admin.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{isset($module_name) ? __(Str::plural($module_name)) : ''}}</h3>
                    <a href="{{ $module_route."/create" }}" class="btn btn-xs btn-primary pull-right">{{__('Add')}}</a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover nowrap" id="dish-table"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>{{__('No.')}}</th>
                                    <th>{{__('Icon')}}</th>
                                    {{-- <th>Status</th> --}}
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    var dishTable = $("#dish-table").DataTable({
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        processing: true,
        serverSide: true,
        // responsive: true,
        stateSave: true,
        ajax: "{!! $module_route.'/datatable' !!}",
        columns: [
            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            {
                data: 'icons_full_path',
                name: 'icons_full_path',
                orderable: false,
                searchable: false,
                render: function(icons_full_path) {
                    return "<img src='" + icons_full_path + "' class='img-thumbnail small-image'>";
                }
                
            },
            // {
            //     data: 'status',
            //     searchable: false,
            //     // orderable: false,
            //     render: function(status) {

            //         if(status){
            //             return "<span class='badge badge-primary'>Active</span>";
            //         }else{
            //             return "<span class='badge badge-warning'>Inactive</span>";
            //         }
            //     }
            // },
            {
                data: null,
                searchable: false,
                orderable: false,
                render: function(data) {
                    var resultStr = '';

                    // resultStr += "<a href='{{ $module_route }}/" + data.id + "/edit' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>";

                    resultStr += "&nbsp;<a href='javascript:void(0);' class='deleteRecord btn btn-xs btn-danger ml-1' val='" + data.id + "'><i class='fa fa-trash-o'></i></a> ";

                    return resultStr;
                }
            }
        ],
        order: [
            [0, 'desc']
        ],
    });

    //delete Record
    $(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var deleteMessage = "{{ __('You want to delete allergen?') }}";
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", dishTable, null, deleteMessage);
    });
</script>
@endpush