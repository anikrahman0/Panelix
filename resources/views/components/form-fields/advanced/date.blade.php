@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group">
    {{ $slot }}
    <input {{ $attributes->whereStartsWith('data') }}
        class="{{$inputClass}} @error($inputValidationID) is-invalid @enderror"
        placeholder="{{$labelText}}"
        {{$inputRequired}}
        name="{{$inputName}}"
        type="date"
        value="{{$inputValue}}"
        min="{{$minValue}}"
        max="{{$maxValue}}"
        id="{{$inputID}}">
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>