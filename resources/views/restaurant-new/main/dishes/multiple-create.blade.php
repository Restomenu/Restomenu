@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : 'Multiple Add')

@push("stylesheets")
<style>
    .input-group-text {
        color: #111 !important;
    }
</style>
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{$module_route}}">{{ isset($module_name) ? __($module_name) : '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><strong>{{__('Multiple Add')}}</strong></li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h5 class="mt-1">{{ isset($module_name) ? __($module_name) : '' }} {{__('Multiple Add')}}</h5>
            </div>
            {!! Form::open(['url' => $module_route."/multiple-store", 'method' => 'POST',
            "enctype"=>"multipart/form-data",'class'=>'form-horizontal','id'=>'form_validate','name'=>'form_general',
            'autocomplete'=>'off']) !!}
            <div class="card-body">

                <div class="all-dishes-block">
                    <div class="border rounded-sm p-4 mt-4 dish-add-block dish-add-main-block d-none">
                        <div class="row">
                            @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('English Name')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::text('name[]', null, ['class'=>"form-control name"]) }}
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
                                            {{ Form::text('name_dutch[]', null, ['class'=>"form-control name_dutch"]) }}
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
                                            {{ Form::text('name_french[]', null, ['class'=>"form-control name_french"]) }}
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
                                        <label class="col-sm-12">{{__('English Description')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::textarea('description[]', null, ['class'=>"form-control description","rows"=>5]) }}
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
                                            {{ Form::textarea('description_dutch[]', null, ['class'=>"form-control description_dutch","rows"=>5]) }}
                                            @if($errors->has('description_dutch'))
                                            <p class="text-danger">{{ $errors->first('description_dutch') }}</p>
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
                                            {{ Form::textarea('description_french[]', null, ['class'=>"form-control description_french","rows"=>5]) }}
                                            @if($errors->has('description_french'))
                                            <p class="text-danger">{{ $errors->first('description_french') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Category')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::select('category_id[]', $categories,  (isset($default) ? $default : null), ["class"=>"form-control category_id"]) }}
                                            @if($errors->has('category_id'))
                                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Price')}}</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                                {{ Form::text('price[]', null, ['class'=>"form-control price"]) }}
                                            </div>
                                            @if($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Status')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::select('status[]', ['1' => __("Active"),'0' => __("Inactive")], null, ['class'=>"form-control status"]) }}

                                            @if($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Take-away')}}</label>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            {{ Form::radio('can_takeaway', 1, true,['id'=>'can_takeaway_yes','class'=>"form-check-input"]) }}
                                                        </label>
                                                        {{ Form::label('can_takeaway_yes', __('Yes')) }}
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            {{ Form::radio('can_takeaway', 0, false,['id'=>'can_takeaway_no','class'=>"form-check-input"]) }}
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
                                </div>
                            </div> --}}
                        </div>
                    
                        <div class="row dish-remove-btn">
                            <div class="col-1 ml-auto">
                            <a class="btn btn-outline-danger"><i class='fa fa-trash-o'></i></a>
                            </div>
                        </div>
                        
                    </div>

                    <div class="border rounded-sm p-4 dish-add-block">
                        <div class="row">
                            @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('English Name')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::text('name[]', null, ['class'=>"form-control name"]) }}
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
                                            {{ Form::text('name_dutch[]', null, ['class'=>"form-control name_dutch"]) }}
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
                                            {{ Form::text('name_french[]', null, ['class'=>"form-control name_french"]) }}
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
                                        <label class="col-sm-12">{{__('English Description')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::textarea('description[]', null, ['class'=>"form-control description","rows"=>5]) }}
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
                                            {{ Form::textarea('description_dutch[]', null, ['class'=>"form-control description_dutch","rows"=>5]) }}
                                            @if($errors->has('description_dutch'))
                                            <p class="text-danger">{{ $errors->first('description_dutch') }}</p>
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
                                            {{ Form::textarea('description_french[]', null, ['class'=>"form-control description_french","rows"=>5]) }}
                                            @if($errors->has('description_french'))
                                            <p class="text-danger">{{ $errors->first('description_french') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Category')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::select('category_id[]', $categories,  (isset($default) ? $default : null), ["class"=>"form-control category_id"]) }}
                                            @if($errors->has('category_id'))
                                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Price')}}</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                                {{ Form::text('price[]', null, ['class'=>"form-control price"]) }}
                                            </div>
                                            @if($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-12">{{__('Status')}}</label>
                                        <div class="col-sm-12">
                                            {{ Form::select('status[]', ['1' => __("Active"),'0' => __("Inactive")], null, ['class'=>"form-control status"]) }}

                                            @if($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-2 dish-add-btn">
                    <div class="col-sm-4 col-sm-4 offset-md-4">
                        <a class="btn btn-block btn-light">{{__('Add')}}</a>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <div class="tr-btn-set">
                            <a href="{{ $module_route }}" class="btn mr-2 btn btn-light">{{__('Cancel')}}</a>
                            <button class="btn btn-primary " id="submit_form_button"
                                type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")

<script type="text/javascript">

    $(document).on('click', '.dish-remove-btn', function() {
        $(this).closest(".dish-add-block").fadeOut();
    });
    
    $(document).on('click', '.dish-add-btn', function() {
        var dishAddBlock = $('.dish-add-main-block').clone();
        dishAddBlock.removeClass('d-none').removeClass('dish-add-main-block');
        $('.all-dishes-block').append(dishAddBlock);
    });

    // input for price
    $(document).on('keypress', '.price', function() {
        $(this).val($(this).val().replace(/[^0-9\.|\,]/g, ""));
        if (event.which == 46) {
            return true;
        }
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $("#form_validate").validate({
        errorPlacement: function errorPlacement(error, element) {
            if ($(element).attr('name') == 'price[]') {
                error.insertAfter($(element).closest('.input-group'));
            } else {
                element.after(error);
            }
        },
    });
    $('[name^=name]').each(function(e) {
        $(this).rules('add', {
            required: true
        });
    });

    $('[name^=price]').each(function(e) {
        $(this).rules('add', {
            required: true
        });
    });

    // $('#form_validate').on('submit', function(event) {

    //     console.log($('.name').length);

    //     $('.name').each(function() {
    //         $(this).rules("add", {
    //             required: true,
    //             messages: {
    //                 required: "Name is required",
    //             }
    //         })
    //     });      

    //     $('[name^=price]').each(function(e) {
    //         $(this).rules('add', {
    //             required: true
    //         });
    //     });
    // });
    // $('#form_validate').validate();

</script>

@endpush