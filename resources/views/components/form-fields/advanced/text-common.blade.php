@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group">
    {{ $slot }}
    <input {{ $attributes->whereStartsWith('data') }}
        type="{{$inputType}}"
        name="{{$inputName}}"
        class="{{$inputClass}} @error($inputValidationID) is-invalid @enderror"
        id="{{$inputID}}"
        placeholder="{{$labelText}}"
        {{$inputRequired}}
        {{$disabled}}
        value="{{$inputValue}}"
        maxlength="{{$maxlength}}"
        >
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>