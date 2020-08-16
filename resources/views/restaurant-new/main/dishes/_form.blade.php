@push("stylesheets")
<style>
    /* .col-form-label {
        padding-left: 15px;
        padding-right: 15px;
        font-weight: bold;
    } */

    .input-group-text {
        color: #111 !important;
    }

    .image_picker_image {
        width: 40px !important;
        max-height: 25px !important;
    }

    .thumbnail.selected {
        border: 2px solid #727cf5 !important;
    }

    .thumbnail {
        background: #fff !important;
        border-radius: 10px;
        border: 2px solid transparent !important;
    }

    .icon-picker-block {
        max-height: 190px;
        background-color: #eeeeee;
        padding: 20px 0px 8px 20px;
        border-radius: 10px;
        box-sizing: content-box;
    }

    .icon-picker-block::-webkit-scrollbar-thumb {
        height: 25%;
        background-color: #999999;
        border: 4px solid transparent;
        border-radius: 8px;
        background-clip: padding-box;
    }

    .icon-picker-block::-webkit-scrollbar {
        height: 20px;
    }
</style>
@endpush
<h3>{{__('Name')}}/{{__('Category')}}</h3>
<section>
    <div class="row">
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

    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Category')}}</label>
        <div class="col-sm-6">
            {{ Form::select('category_id', $categories,  (isset($default) ? $default : null), ['id'=>'category_id',"class"=>"form-control"]) }}

            @if($errors->has('category_id'))
            <p class="text-danger">{{ $errors->first('category_id') }}</p>
            @endif
        </div>
    </div>
</section>

{{-- <h3>Category Description</h3>
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

<h3>{{__('Price')}}/{{__('Take-away')}}</h3>
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
                            {{ Form::radio('can_takeaway', 1, true,['id'=>'can_takeaway_yes','class'=>"form-check-input"]) }}
                        </label>
                        {{ Form::label('can_takeaway_yes', __('Yes')) }}
                    </div>
                </div>
                <div class="col-sm-3">
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
</section>

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
    @isset($result->dish_image_full_path)
    <div class="row">
        <div class="col-sm-6 offset-sm-2">
            <img src={{$result->dish_image_full_path}} id="image-preview" class='medium-image' />
        </div>
    </div>
    @else
    <div class="row image-preview-block d-none">
        <div class="col-sm-6 offset-sm-2">
            <img src="#" id="image-preview" class='medium-image' />
        </div>
    </div>
    @endisset

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">{{__('Allergens')}}</label>

        <div class="col-sm-6 overflow-auto icon-picker-block">
            <select multiple="multiple" class="image-picker show-html select-icon" name="allergens_icons[]">

                @foreach ($allergens as $icon)

                @isset($result)
                <option data-img-src="{{$icon->icons_full_path}}" value="{{$icon->id}}"
                    {{in_array($icon->id, $allergensList)? 'selected' : ''}}>{{$icon->icon}}</option>

                @else

                <option data-img-src="{{$icon->icons_full_path}}" value="{{$icon->id}}">{{$icon->icon}}</option>

                @endisset

                @endforeach

            </select>
        </div>
    </div>

</section>
<h3>{{__('State')}}/{{__('Status')}}</h3>
<section>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('State')}}</label>
        <div class="col-sm-6">
            {{ Form::text('state', null, ['id' => 'state', 'class'=>"form-control"]) }}
            @if($errors->has('state'))
            <p class="text-danger">{{ $errors->first('state') }}</p>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-sm-2">{{__('Status')}}</label>
        <div class="col-sm-6">
            {{ Form::select('status', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'status', 'class'=>"form-control"]) }}

            @if($errors->has('status'))
            <p class="text-danger">{{ $errors->first('status') }}</p>
            @endif
        </div>
    </div>
</section>
@push("scripts")

<script type="text/javascript">
    var dishId = "{{ isset($result) ? $result->id : null}}";

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
        if (!dishId) {
            $('.image-preview-block').removeClass('d-none');
        }
        readURL(this);
    });

    @include('restaurant-new.main.general.jquery-steps')
    $(".select-icon").imagepicker();
</script>

@endpush