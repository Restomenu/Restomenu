@extends('admin.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{ __(Str::plural($module_name)) }}</h3>
                    <!-- <div class="pull-right">
                        <a href="{{ $module_route."/create" }}" class="btn btn-xs btn-primary ">{{__('Add')}}</a>
                    </div> -->
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover nowrap" id="restaurant-table"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="rm-cat-no-column">{{__('No.')}}</th>
                                    <th>{{__('Restaurant Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                <th>{{__('Shipping Cost')}}</th>
                                <th>{{__('Sticker Cost')}}</th>
                                <th>{{__('Total Cost')}}</th>
                                <th>{{__('Address')}}</th>  
                                <th>{{__('Postcode')}}</th>
                                <th>{{__('City')}}</th>
                                <th>{{__('Country')}}</th>
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
    var clipboard = new ClipboardJS('.copy-btn');

	clipboard.on('success', function(e) {
		var ele = e.trigger;
        var message = $(ele).attr('data-tooltip-text');
        
		setTooltip(ele, message);
		hideTooltip(ele);
    });

    function setTooltip(btn, message) {
		$(btn).attr('data-original-title', message).tooltip('show');
	}

	function hideTooltip(btn) {
		setTimeout(function() {
			$(btn).tooltip('hide').removeAttr("data-original-title");
		}, 800);
	}

    var restaurantTable = $("#restaurant-table").DataTable({
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        processing: true,
        serverSide: true,
        responsive: true,
        stateSave: true,
        ajax: "{!! $module_route.'/datatable' !!}",
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            
            {
                data: 'restaurant_name',
                name: 'restaurant_name',
                defaultContent: "N/A",
            },
            {
                data: 'restaurant_email',
                name: 'restaurant_email',
                defaultContent: "N/A",
            },
            
            {
                data: 'quantity',
                name: "quantity",
                defaultContent: "N/A",
            },
            {
                data: 'shipping_cost',
                name: "shipping_cost",
                defaultContent: "N/A",
            },

            {
                data: 'sticker_cost',
                name: "sticker_cost",
                defaultContent: "N/A",
            },
            {
                data: 'total_cost',
                name: "total_cost",
                defaultContent: "N/A",
            },
            {
                data: 'address',
                name: "address",
                defaultContent: "N/A",
            },
            {
                data: 'postcode',
                name: "postcode",
                defaultContent: "N/A",
            },
            {
                data: 'city',
                name: "city",
                defaultContent: "N/A",
            },
            {
                data: 'country',
                name: "country",
                defaultContent: "N/A",
            }

            // {
            //     data: null,
            //     name: 'slug',
            //     render: function(o) {
                    
			// 		var str = "<div class='custom-url-block'>";
            //         str += `<a href='{{env('APP_URL')}}/${o.slug}' target="__blank"><div class='custom-url'>{{env('APP_URL')}}/${o.slug}</div></a>`;
                    
			// 		str += '&nbsp;&nbsp;<div class="custom-url-copy"><a class="copy-btn"  data-clipboard-text="'+"{{env('APP_URL')}}/" + o.slug+'" data-tooltip-text="Menu url copied!"><img src="{{asset("admin/images/sheet.svg")}}" height="12px" title="Copy URL"></a></div>';
            //         str += "</div>";

            //         return str;
            //     }
            // },
            // {
            //     data: 'status',
            //     searchable: false,
            //     // orderable: false,    
            //     render: function(status) {

            //         if (status) {
            //             return "<span class='badge badge-primary'>Active</span>";
            //         } else {
            //             return "<span class='badge badge-warning'>Inactive</span>";
            //         }
            //     }
            // },
            // {
            //     data: 'category_image_full_path',
            //     name: 'category_image_full_path',
            //     orderable: false,
            //     searchable: false,
            //     render: function(category_image_full_path) {
            //         return "<img src='" + category_image_full_path + "' class='img-thumbnail small-image'>";
            //     }

            // },
            // {
            //     data: null,
            //     searchable: false,
            //     orderable: false,
            //     render: function(data) {
            //         var resultStr = '';

            //         var impersonateUrl = '{{ route("impersonate", ":id") }}';
            //         impersonateUrl = impersonateUrl.replace(':id', data.id);
                    
            //         resultStr += "<a href='" + impersonateUrl + "' target='__blank' class='btn btn-xs btn-info'><i class='fa fa-sign-in' aria-hidden='true'></i></a>";

            //         resultStr += "<a href='{{ $module_route }}/" + data.id + "/edit' class='btn btn-xs btn-primary ml-2'><i class='fa fa-edit'></i></a>";

            //         resultStr += "&nbsp;<a href='javascript:void(0);' class='deleteRecord btn btn-xs btn-danger ml-1' val='" + data.id + "'><i class='fa fa-trash-o'></i></a> ";

            //         return resultStr;
            //     }
            // }
        ],
        order: [
            [0, 'desc']
        ],
    });

    //delete Record
    $(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var deleteMessage = "{{ __('You want to delete Restaurant?') }}";
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", restaurantTable, null, deleteMessage);
    });
</script>
@endpush