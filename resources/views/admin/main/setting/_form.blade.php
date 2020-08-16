@push("styles")
<style>
    .col-form-label {
        padding-left: 15px;
        padding-right: 15px;
        font-weight: bold;
    }
</style>
@endpush
{{-- {{dd($setting)}} --}}
@if ($result['key']=='language_english' ||$result['key']=='language_dutch'||$result['key']=='language_french'
||$result['key']=='admin_language_english'
||$result['key']=='admin_language_dutch'||$result['key']=='admin_language_french' )

<div class="form-group row">
    <label class="col-form-label col-sm-2">{{$result['display_name']}}</label>
    <div class="col-sm-6">
        {{ Form::hidden('key', null, ['id' => 'key']) }}
        {{ Form::select('value', ['1' => "Active",'0' => "Inactive"], null, ['id' => 'value', 'class'=>"form-control"]) }}

        @if($errors->has('value'))
        <p class="text-danger">{{ $errors->first('value') }}</p>
        @endif
    </div>
</div>
@endif
@if ($result['key']=='site_logo')
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{$result['display_name']}}</label>
    <div class="col-sm-6">
        {{ Form::hidden('key', null, ['id' => 'key']) }}

        {{ Form::file("value", ["class"=>"form-control", "id" => "value"]) }}

        @if($errors->has('value'))
        <p class="text-danger">{{ $errors->first('value') }}</p>
        @endif
    </div>
</div>
@endif
@if ($result['key']=='site_name')
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{$result['display_name']}}</label>
    <div class="col-sm-6">
        {{ Form::hidden('key', null, ['id' => 'key']) }}

        {{ Form::text('value', null, ['id' => 'value', 'class'=>"form-control"]) }}
        @if($errors->has('value'))
        <p class="text-danger">{{ $errors->first('value') }}</p>
        @endif
    </div>
</div>
@endif

@if ($result['key']=='defualt_language')

<div class="form-group row">
    <label class="col-form-label col-sm-2">{{$result['display_name']}}</label>
    <div class="col-sm-6">
        {{ Form::hidden('key', null, ['id' => 'key']) }}

        {{ Form::select('value', $selectedLanguage,  (isset($result) ? $result->value : null), ['id'=>'value',"class"=>"form-control"]) }}

        @if($errors->has('value'))
        <p class="text-danger">{{ $errors->first('value') }}</p>
        @endif
    </div>
</div>
@endif

@if (in_array($result['key'],['fb_url','ig_url','tw_url']))
<div class="form-group row">
    <label class="col-form-label col-sm-2">{{$result['display_name']}}</label>
    <div class="col-sm-6">
        {{ Form::hidden('key', null, ['id' => 'key']) }}

        {{ Form::text('value', null, ['id' => 'value', 'class'=>"form-control"]) }}
        @if($errors->has('value'))
        <p class="text-danger">{{ $errors->first('value') }}</p>
        @endif
    </div>
</div>
@endif

@push("scripts")

{{-- <script type="text/javascript">
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
                    required: true
                },
                description: {
                    required: false,
                    maxlength: 255
                }
            }
        });
    });
</script> --}}

@endpush