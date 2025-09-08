@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group">
    {{ $slot }}
    <textarea {{ $attributes->whereStartsWith('data') }}
        class="{{ $inputClass }} @error($inputValidationID) is-invalid @enderror"
        placeholder="{{$labelText}}"
        {{$inputRequired}}
        name="{{$inputName}}"
        id="{{$inputID}}"
        rows="{{$rows}}"
        cols="{{$cols}}"
        maxlength="{{$maxlength}}">{{$inputValue}}</textarea>
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>