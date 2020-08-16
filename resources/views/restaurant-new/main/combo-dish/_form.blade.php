@push("stylesheets")
<style>
    .input-group-text {
        color: #111 !important;
    }
</style>
@endpush
<h3>{{__('Make Combo')}}</h3>
<section>

    <div class="row">
        <label class="col-sm-2">{{__('Make Combo')}}</label>
        <div class="col-sm-10">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="rm-category-class"><label class="col-form-label">{{__('Category')}}</label></th>
                            <th class="rm-dish-class"><label class="col-form-label">{{__('Dish')}}</label></th>
                            <th class="rm-quant-class"><label class="col-form-label">{{__('Quantity')}}</label></th>
                            <th class="rm-action-class"><label class="col-form-label">{{__('Action')}}</label></th>
                        </tr>
                    </thead>
                    <tbody class="table-body">

                        <tr class="clone-row d-none">
                            <td>
                                {{ Form::select('combo_dish[category][]', $categories, null, ['class'=>"combo-dish-category-hide form-control",'placeholder' => __('Please Select Category'),'disabled'=>'disabled'])
                            }}
                            </td>
                            <td>
                                {{ Form::select('', [], null, ['class'=>"combo-dish-dish-hide form-control",'disabled'=>'disabled',"multiple"]) }}
                            </td>
                            <td>
                                {{ Form::text('combo_dish[quantity][]', 1, ['class'=>"combo-dish-quantity form-control",'disabled'=>'disabled']) }}
                            </td>
                            <td>
                                {{ Form::hidden('combo_dish[deleteId][]', null,['class'=>'combo-dish-delete','disabled'=>'disabled']) }}
                                <a href='javascript:void(0);' class='deleteRecord text-danger btn-action' data-combo-dish-category-id="">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                        @if (!isset($result))
                        <tr data-row-id="0">
                            <td>
                                {{ Form::select('combo_dish[category][]', $categories, null, ['class'=>"combo-dish-category form-control combo-dish-category_0",'placeholder' => __('Please Select Category')]) }}
                            </td>
                            <td>
                                {{ Form::select('combo_dish[dish][0][]', [], null, ['class'=>"combo-dish-dish form-control combo-dish-dish_0","multiple"=>"multiple"]) }}
                            </td>
                            <td>
                                {{ Form::text('combo_dish[quantity][]', 1, ['class'=>"combo-dish-quantity form-control"]) }}
                            </td>
                            <td>
                                {{ Form::hidden('combo_dish[deleteId][]', null,['class'=>'combo-dish-delete']) }}
                                <a href='javascript:void(0);' class='deleteRecord text-danger btn-action' data-combo-dish-category-id="">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                        @else

                        @foreach ($result->comboDishCategories as $key => $comboDishCategory)
                        <tr data-row-id="{{$key.'_edit'}}">
                            <td>
                                {{ Form::hidden('combo_dish[id][]', $comboDishCategory->id) }}
                                {{ Form::select('combo_dish[category][]', $categories, $comboDishCategory->category_id, ['class'=>"combo-dish-category form-control combo-dish-category_".$key.'_edit','placeholder' => __('Please Select Category')]) }}
                            </td>
                            <td>
                                {{ Form::select('combo_dish[dish]['.$key.'][]', $comboDishCategory['dishes'], $comboDishCategory->comboDishDishValues, ['class'=>"combo-dish-dish form-control combo-dish-dish_".$key.'_edit',"multiple"]) }}
                            </td>
                            <td>
                                {{ Form::text('combo_dish[quantity][]', $comboDishCategory->dish_quantity, ['class'=>"combo-dish-quantity form-control"]) }}
                            </td>
                            <td>
                                {{ Form::hidden('combo_dish[deleteId][]', null,['class'=>'combo-dish-delete']) }}
                                <a href='javascript:void(0);' class='deleteRecord text-danger btn-action' data-combo-dish-category-id="{{$comboDishCategory->id}}">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @endif


                    </tbody>
                </table>
                <td>
                    <a href='javascript:void(0);' class='add-row-btn btn btn-primary btn-action mt-3' data-subject-id="">
                        {{__('Add')}}
                    </a>
                </td>
            </div>
        </div>
    </div>
</section>

<h3>{{__('Name')}}</h3>
<section>

    <div class="row mt-4">
        @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('English Name')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('name', null, ['id' => 'name', 'class'=>"form-control"]) }}
                        @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('Dutch Name')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('name_dutch', null, ['id' => 'name_dutch', 'class'=>"form-control"]) }}
                        @if($errors->has('name_dutch'))
                        <p class="text-danger">{{ $errors->first('name_dutch') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->guard('restaurant')->user()->setting->admin_language_french ==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('French Name')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('name_french', null, ['id' => 'name_french', 'class'=>"form-control"]) }}
                        @if($errors->has('name_french'))
                        <p class="text-danger">{{ $errors->first('name_french') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="row">
        @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('English Subtitle')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('sub_title', null, ['id' => 'sub_title', 'class'=>"form-control"]) }}
                        @if($errors->has('sub_title'))
                        <p class="text-danger">{{ $errors->first('sub_title') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('Dutch Subtitle')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('sub_title_dutch', null, ['id' => 'sub_title_dutch', 'class'=>"form-control"]) }}
                        @if($errors->has('sub_title_dutch'))
                        <p class="text-danger">{{ $errors->first('sub_title_dutch') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->guard('restaurant')->user()->setting->admin_language_french ==1)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-12">{{__('French Subtitle')}}</label>
                    <div class="col-sm-12">
                        {{ Form::text('sub_title_french', null, ['id' => 'sub_title_french', 'class'=>"form-control"]) }}
                        @if($errors->has('sub_title_french'))
                        <p class="text-danger">{{ $errors->first('sub_title_french') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- <h3>Dish Description</h3>
<section>
<div class="row">
    @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <div class="row">
                <label class="col-sm-12">{{__('English Description')}}</label>
<div class="col-sm-12">
    {{ Form::textarea('description', null, ['id' => 'description', 'class'=>"form-control","rows"=>5]) }}
    @if($errors->has('description'))
    <p class="text-danger">{{ $errors->first('description') }}</p>
    @endif
</div>
</div>
</div>
</div>
@endif

@if(auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
<div class="col-12 col-sm-4">
    <div class="form-group">
        <div class="row">
            <label class="col-sm-12">{{__('Dutch Description')}}</label>
            <div class="col-sm-12">
                {{ Form::textarea('description_dutch', null, ['id' => 'description_dutch', 'class'=>"form-control","rows"=>5]) }}
                <p class="text-danger">{{ $errors->first('description_dutch') }}</p>
                @if($errors->has('description_dutch'))
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@if(auth()->guard('restaurant')->user()->setting->admin_language_french ==1)
<div class="col-12 col-sm-4">
    <div class="form-group">
        <div class="row">
            <label class="col-sm-12">{{__('French Description')}}</label>
            <div class="col-sm-12">
                {{ Form::textarea('description_french', null, ['id' => 'description_french', 'class'=>"form-control","rows"=>5]) }}
                @if($errors->has('description_french'))
                <p class="text-danger">{{ $errors->first('description_french') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
</div>
</section> --}}

<h3>{{__('Image')}}</h3>
<section>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Image')}}</label>
        <div class="col-sm-6">
            {{ Form::file("image", ["class"=>"form-control", "id" => "image"]) }}

            @if($errors->has('image'))
            <p class="text-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>
    </div>

    @isset($result->combo_dish_image_full_path)
    <div class="row">
        <div class="col-sm-6 offset-sm-2">
            <img src={{$result->combo_dish_image_full_path}} id="image-preview" class='medium-image'>
        </div>
    </div>
    @else
    <div class="row image-preview-block d-none">
        <div class="col-sm-6 offset-sm-2">
            <img src="#" id="image-preview" class='medium-image' />
        </div>
    </div>
    @endisset
</section>

<h3>{{__('Price')}}/{{__('Take-away')}}/{{__('Status')}}</h3>
<section>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Price')}}</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                {{ Form::text('price', null, ['id' => 'price', 'class'=>"form-control"]) }}
            </div>
            @if($errors->has('price'))
            <p class="text-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Take-away')}}</label>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            {{ Form::radio('can_takeaway', 1, true,['id'=>'can_takeaway_yes']) }}
                        </label>
                        {{ Form::label('can_takeaway_yes', __('Yes')) }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            {{ Form::radio('can_takeaway', 0, false,['id'=>'can_takeaway_no']) }}
                        </label>
                        {{ Form::label('can_takeaway_no', __('No')) }}
                    </div>
                </div>
            </div>

            @if($errors->has('can_takeaway'))
            <p class="text-danger">{{ $errors->first('can_takeaway') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Status')}}</label>
        <div class="col-sm-6">
            {{ Form::select('status', ['1' => "Active",'0' => "Inactive"], null, ['id' => 'status', 'class'=>"form-control"]) }}

            @if($errors->has('status'))
            <p class="text-danger">{{ $errors->first('status') }}</p>
            @endif
        </div>
    </div>
</section>


@push("scripts")

<script type="text/javascript">
    var comboDishId = "{{ isset($result) ? $result->id : null}}";

    // input for price
    $(document).on('keypress', '#price', function() {
        $(this).val($(this).val().replace(/[^0-9\.|\,]/g, ""));
        if (event.which == 46) {
            return true;
        }
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(document).ready(function() {
        var row_id = 1;
        @if(isset($result))
        row_id = "{{ count($result->comboDishCategories)}}";
        @endif

        $('.clone-row').addClass('d-none');

        $(".add-row-btn").click(function(e) {
            var originalRow = $(".clone-row").clone();
            originalRow.removeClass('d-none');
            originalRow.removeClass('clone-row');
            originalRow.attr('data-row-id', row_id);
            originalRow.find('.combo-dish-category-hide').addClass('combo-dish-category_' + row_id);
            originalRow.find('.combo-dish-category-hide').addClass('combo-dish-category');
            originalRow.find('.combo-dish-category-hide').removeAttr('disabled');

            originalRow.find('.combo-dish-dish-hide').addClass('combo-dish-dish_' + row_id);
            originalRow.find('.combo-dish-dish-hide').addClass('combo-dish-dish');
            originalRow.find('.combo-dish-dish-hide').removeAttr('disabled');
            originalRow.find('.combo-dish-dish-hide').attr('name', 'combo_dish[dish][' + row_id + '][]');

            originalRow.find('.combo-dish-quantity').val('1');
            originalRow.find('.combo-dish-quantity').removeAttr('disabled');
            originalRow.find('.combo-dish-delete').removeAttr('disabled');
            $('.table-body').append(originalRow);
            e.preventDefault();

            $('.combo-dish-category').select2({
                placeholder: "{{__('Please Select Category')}}",
                width: "200px"
            });
            $('.combo-dish-dish').select2({
                placeholder: "{{__('Please Select Dish')}}",
                width: "200px"
            });

            row_id++;
        });

        $('.combo-dish-category').select2({
            placeholder: "{{__('Please Select Category')}}",
            width: "200px"
        });
        $('.combo-dish-dish').select2({
            placeholder: "{{__('Please Select Dish')}}",
            width: "200px"
        });

        $(document).on('click', '.deleteRecord', function() {

            let deleteId = 1;
            if ($(this).data('combo-dish-category-id')) {
                deleteId = $(this).data('combo-dish-category-id');
            }

            $(this).siblings('.combo-dish-delete').val(deleteId);
            $(this).closest("tr").fadeOut();
            // $(this).closest("tr").fadeOut("normal", function() {
            //     $(this).remove();
            // });
        });

        $(document).on('select2:select', '.combo-dish-category', function() {
            let categoryId = $(this).val();
            let rowId = $(this).closest('tr').data('row-id');

            $.ajax({
                url: "{{route('restaurant.getDishes')}}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: categoryId
                },
                success: function(data) {
                    $('.combo-dish-dish_' + rowId).html('');
                    $('.combo-dish-dish_' + rowId).attr('name', 'combo_dish[dish][' + rowId + '][]').html(data.options);
                    $('.combo-dish-dish_' + rowId).val(null).trigger("change");
                }
            });
        });
    });

    //     $("#form_validate").validate({
    //         ignore: [],
    //         errorElement: 'p',
    //         errorClass: 'text-danger',
    //         normalizer: function(value) {
    //             return $.trim(value);
    //         },
    //         rules: {
    //             name: {
    //                 required: true,
    //                 maxlength: 191
    //             },
    //             price: {
    //                 required: true,
    //                 maxlength: 191
    //             }
    //             // description: {
    //             //     required: true,
    //             //     maxlength: 255
    //             // }
    //         },
    //         messages: {
    // 		    name: {
    // 			    required: "@lang('This field is required.')",
    //                 maxlength:"@lang('Please enter no more than 191 characters.')"
    // 		    },
    //             price:{
    //                 required: "@lang('This field is required.')",
    //                 maxlength:"@lang('Please enter no more than 191 characters.')"
    //             }
    // 	    },
    //     });

    var form = $("#form_validate");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            if ($(element).attr('name') == 'price') {
                error.insertAfter($(element).closest('.input-group'));
            } else {
                element.after(error);
            }
        },
        rules: {
            name: {
                required: true,
                maxlength: 191

            },
            name_dutch: {
                required: true,
                maxlength: 191

            },
            name_french: {
                required: true,
                maxlength: 191

            },
            price: {
                required: true,
                maxlength: 191
            }
        },
        messages: {
            name: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"

            },
            name_dutch: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"

            },
            name_french: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"

            },
            price: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            }
        },
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change', '#image', function() {
        if (!comboDishId) {
            $('.image-preview-block').removeClass('d-none');
        }
        readURL(this);
    });

    @include('restaurant-new.main.general.jquery-steps')
</script>

@endpush