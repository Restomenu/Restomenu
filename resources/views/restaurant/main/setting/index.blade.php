@extends('restaurant.layouts.default')

@section('title', __('Settings'))

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{__('Settings')}}</h3>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover nowrap" id="setting-table"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>{{__('No.')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('value')}}</th>
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
    var dishTable = $("#setting-table").DataTable({
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        processing: true,
        serverSide: true,
        responsive: true,
        stateSave: true,
        ajax: "{!! $module_route.'/datatable' !!}",
        columns: [
            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            {
                data: 'display_name',
                name: "display_name",
                defaultContent: "N/A",
            },
                     
            {
                data: null,
                searchable: false,
                // orderable: false,
                render: function(data) {
                   if((data.key == 'language_english') || (data.key == 'language_dutch') || (data.key == 'language_french'||data.key == 'admin_language_english') || (data.key == 'admin_language_dutch') || (data.key == 'admin_language_french') ){
                        if(data.value==1){
                            return "<span class='badge badge-primary'>Active</span>";
                        }else{
                            return "<span class='badge badge-warning'>Inactive</span>";
                        }
                    }
                    if(data.key == 'site_logo'){
                        return "<img src='" + data.logo_full_path + "' class='img-thumbnail small-image'>";

                    }
                    if(data.key=='site_name'){
                        return data.value;
                    }
                    if(data.key=='defualt_language'){
                        return data.value;
                    }
                    if($.inArray(data.key, ['fb_url','ig_url','tw_url']) != -1) {
                        if(data.value){
                            return `<a href="${data.value}" target="_blank">${data.value}</a>`;
                        }
                        return data.value;
                    }
             
                }
            },
            {
                data: null,
                searchable: false,
                orderable: false,
                render: function(data) {
                    var resultStr = '';
                    resultStr += "<a href='{{ $module_route }}/" + data.id + "/edit?setting="+data.key+"' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>";
                   
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
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", dishTable);
    });
</script>
@endpush