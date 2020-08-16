@if(!empty($dishes))
  @foreach($dishes as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif