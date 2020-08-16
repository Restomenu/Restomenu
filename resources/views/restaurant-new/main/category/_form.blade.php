@push("stylesheets")
<style>
    /* .col-form-label {
        font-weight: bold;
    } */

    .image_picker_image {
        width: 40px !important;
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

<h3>{{__('Name')}}</h3>
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
                    <label class=" col-sm-12">{{__('Dutch Name')}}</label>
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
                    <label class=" col-sm-12">{{__('French Name')}}</label>
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
</section>

{{-- <h3>Category Description</h3>
<section>
<div class="row">
    @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <div class="row">
                <label class=" col-sm-12">{{__('English Description')}}</label>
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
            <label class=" col-sm-12">{{__('Dutch Description')}}</label>
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

@if(auth()->guard('restaurant')->user()->setting->admin_language_french==1)
<div class="col-12 col-sm-4">
    <div class="form-group">
        <div class="row">
            <label class=" col-sm-12">{{__('French Description')}}</label>
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

{{-- <div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class=" col-sm-2">Image</label>
    <div class="col-sm-6">
        {{ Form::file("image", ["class"=>"form-control", "id" => "image"]) }}

@if($errors->has('image'))
<p class="text-danger">{{ $errors->first('image') }}</p>
@endif
</div>
</div> --}}
<h3>{{__('Icon')}}</h3>
<section>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">{{__('Icon')}}</label>

        <div class="col-sm-6 overflow-auto icon-picker-block">
            <select class="image-picker show-html select-icon" name="image">

                @foreach ($category_icons as $icon)

                @isset($result)
                <option data-img-src="{{$icon->icons_full_path}}" value="{{$icon->icon}}" {{$result->image == $icon->icon ? 'selected' : ''}}>{{$icon->icon}}</option>

                @else

                <option data-img-src="{{$icon->icons_full_path}}" value="{{$icon->icon}}">{{$icon->icon}}</option>

                @endisset

                @endforeach

            </select>
        </div>
    </div>
</section>
<h3>{{__('Status')}}</h3>
<section>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">{{__('Status')}}</label>
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
    // $(document).ready(function() {
    //     $(".select-icon").imagepicker();

    //     $("#form_validate").validate({
    //         ignore: [],
    //         errorElement: 'p',
    //         errorClass: 'text-danger',
    //         normalizer: function(value) {
    //             return $.trim(value);
    //         },
    //         rules: {
    //             name: {
    //                 required: true
    //             },
    //             // description: {
    //             //     required: false,
    //             //     maxlength: 255
    //             // }
    //         },
    //         messages: {
    // 		    name: {
    // 			    required: "@lang('This field is required.')",
    // 		    },
    //             // description:{
    //             //     required: "@lang('This field is required.')",
    //             // }
    // 	    },
    //     });
    // });
    
    var form = $("#form_validate");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.after(error);
        },
        rules: {
            name: {
                required: true
            },
            name_dutch: {
                required: true
            },
            name_french: {
                required: true
            },
        },
        messages: {
            name: {
                required: "@lang('This field is required.')",
            },
            name_dutch: {
                required: "@lang('This field is required.')",
            },
            name_french: {
                required: "@lang('This field is required.')",
            }
            // }

        },
    });

    @include('restaurant-new.main.general.jquery-steps')

    $(".select-icon").imagepicker();
</script>
@endpush