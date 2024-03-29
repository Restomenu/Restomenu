@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">{{__(Str::plural($module_name))}}</h4>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="ml-auto">
                            <a href="{{ $module_route."/create" }}"
                                class="btn btn-sm btn-primary pull-right">{{__('Add')}}</a>
                            <a href="{{ $module_route."/multiple-create" }}"
                                class="btn btn-sm btn-primary pull-right mr-2">{{__('Multiple Add')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dish-table" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    {{-- <th>{{__('No.')}}</th> --}}
                                    <th>{{__('Name')}}</th>
                                    {{-- <th>{{__('Description')}}</th> --}}
                                    <th>{{__('Price')}} (€)</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Status')}}</th>
                                    {{-- <th>{{__('Image')}}</th> --}}
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
        responsive: true,
        stateSave: true,
        autoWidth: false,
        "oLanguage": {
            "sEmptyTable":     "{{__('No data available in table')}}",
            "sInfo":           "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
            "sInfoEmpty":      "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
            "sInfoFiltered":   "({{__('filtered from')}} _MAX_ {{__('total')}} {{__('entries')}})",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "{{__('Show')}} _MENU_ {{__('entries')}}",
            "sLoadingRecords": "{{__('Loading...')}})",
            "sProcessing":     "{{__('Processing...')}}",
            "sSearch":         "{{__('Search')}}:",
            "sZeroRecords":    "{{__('No matching records found')}}",
            "oPaginate": {
                "sFirst":    "{{__('First')}}",
                "sLast":     "{{__('Last')}}",
                "sNext":     "{{__('Next')}}",
                "sPrevious": "{{__('Previous')}}"
            },
            
        },
        // scrollX: true,
        ajax: "{!! $module_route.'/datatable' !!}",
        columns: [
            // {
            //     data: 'DT_RowIndex',
            //     searchable: false,
            //     orderable: false,
            //     width: '10%'
            // },
            {
                data: 'name',
                name: "dishes.name",
                defaultContent: "N/A",
                width: '10%'
            },
            // {
            //     data: 'description',
            //     name: "dishes.description",
            //     defaultContent: "N/A",
            //     width: '10%'
            // },
            {
                data: 'price',
                name: "price",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'category_name',
                name: "categories.name",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'status',
                searchable: false,
                width: '10%',
                // orderable: false,
                render: function(status) {

                    if (status) {
                        return "<span class='badge badge-primary'>{{__('Active')}}</span>";
                    } else {
                        return "<span class='badge badge-warning'>{{__('Inactive')}}</span>";
                    }
                }
            },
            // {
            //     data: 'dish_image_full_path',
            //     name: 'dish_image_full_path',
            //     width: '10%',
            //     orderable: false,
            //     searchable: false,
            //     render: function(dish_image_full_path) {
            //         return "<img src='" + dish_image_full_path + "' class='small-image'>";
            //     }

            // },
            {
                data: null,
                searchable: false,
                orderable: false,
                width: '10%',
                render: function(data) {
                    var resultStr = '';

                    resultStr += "<a href='{{ $module_route }}/" + data.id + "/edit' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>";

                    resultStr += "&nbsp;<a href='javascript:void(0);' class='deleteRecord btn btn-xs btn-danger ml-1' val='" + data.id + "'><i class='fa fa-trash-o'></i></a> ";

                    return resultStr;
                }
            }
        ],
        // order: [
        //     [0, 'desc']
        // ],
    });

    //delete Record
    $(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var deleteMessage = "{{ __('You want to delete Dish?') }}";
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", dishTable, null, deleteMessage);
    });
</script>
@endpush