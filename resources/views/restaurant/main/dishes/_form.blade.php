@push("styles")
<style>
    .col-form-label {
        padding-left: 15px;
        padding-right: 15px;
        font-weight: bold;
    }
</style>
@endpush

<div class="row">
    @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('English Name')}}</label>
            <div class="col-sm-12">
                {{ Form::text('name', null, ['id' => 'name', 'class'=>"form-control"]) }}
                @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

        </div>
    </div>
    @endif

    @if(auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('Dutch Name')}}</label>
            <div class="col-sm-12">
                {{ Form::text('name_dutch', null, ['id' => 'name_dutch', 'class'=>"form-control"]) }}
                @if($errors->has('name_dutch'))
                <p class="text-danger">{{ $errors->first('name_dutch') }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    @if(auth()->guard('restaurant')->user()->setting->admin_language_french ==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('French Name')}}</label>
            <div class="col-sm-12">
                {{ Form::text('name_french', null, ['id' => 'name_french', 'class'=>"form-control"]) }}
                @if($errors->has('name_french'))
                <p class="text-danger">{{ $errors->first('name_french') }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>

<div class="hr-line-dashed"></div>
<div class="row">
    @if(auth()->guard('restaurant')->user()->setting->admin_language_english==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('English Description')}}</label>
            <div class="col-sm-12">
                {{ Form::textarea('description', null, ['id' => 'description', 'class'=>"form-control","rows"=>5]) }}
                @if($errors->has('description'))
                <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    @if(auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('Dutch Description')}}</label>
            <div class="col-sm-12">
                {{ Form::textarea('description_dutch', null, ['id' => 'description_dutch', 'class'=>"form-control","rows"=>5]) }}
                <p class="text-danger">{{ $errors->first('description_dutch') }}</p>
                @if($errors->has('description_dutch'))
                @endif
            </div>
        </div>
    </div>
    @endif

    @if(auth()->guard('restaurant')->user()->setting->admin_language_french ==1)
    <div class="col-12 col-sm-4">
        <div class="row">
            <label class="col-form-label col-sm-12">{{__('French Description')}}</label>
            <div class="col-sm-12">
                {{ Form::textarea('description_french', null, ['id' => 'description_french', 'class'=>"form-control","rows"=>5]) }}
                @if($errors->has('description_french'))
                <p class="text-danger">{{ $errors->first('description_french') }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Category')}}</label>
    <div class="col-sm-6">
        {{ Form::select('category_id', $categories,  (isset($default) ? $default : null), ['id'=>'category_id',"class"=>"form-control"]) }}

        @if($errors->has('category_id'))
        <p class="text-danger">{{ $errors->first('category_id') }}</p>
        @endif
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Price')}}</label>
    <div class="col-sm-6">
        {{ Form::text('price', null, ['id' => 'price', 'class'=>"form-control"]) }}
        @if($errors->has('price'))
        <p class="text-danger">{{ $errors->first('price') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Take-away')}}</label>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-3">
                {{ Form::radio('can_takeaway', 1, true,['id'=>'can_takeaway_yes']) }}
                {{ Form::label('can_takeaway_yes', __('Yes')) }}
            </div>
            <div class="col-sm-3">
                {{ Form::radio('can_takeaway', 0, false,['id'=>'can_takeaway_no']) }}
                {{ Form::label('can_takeaway_no', __('No')) }}
            </div>
        </div>

        @if($errors->has('can_takeaway'))
        <p class="text-danger">{{ $errors->first('can_takeaway') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Image')}}</label>
    <div class="col-sm-6">
        {{ Form::file("image", ["class"=>"form-control", "id" => "image"]) }}

        @if($errors->has('image'))
        <p class="text-danger">{{ $errors->first('image') }}</p>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('State')}}</label>
    <div class="col-sm-6">
        {{ Form::text('state', null, ['id' => 'state', 'class'=>"form-control"]) }}
        @if($errors->has('state'))
        <p class="text-danger">{{ $errors->first('state') }}</p>
        @endif
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Status')}}</label>
    <div class="col-sm-6">
        {{ Form::select('status', ['1' => __("Active"),'0' => __("Inactive")], null, ['id' => 'status', 'class'=>"form-control"]) }}

        @if($errors->has('status'))
        <p class="text-danger">{{ $errors->first('status') }}</p>
        @endif
    </div>
</div>

@push("scripts")

<script type="text/javascript">
    $(document).ready(function() {

        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                name: {
                    required: true,
                    maxlength: 191
                },
                description: {
                    required: false,
                }
            },
            messages: {
			    name: {
				    required: "@lang('This field is required.')",
                    maxlength:"@lang('Please enter no more than 191 characters.')"
			    },
		    },
        });
    });
</script>

@endpush