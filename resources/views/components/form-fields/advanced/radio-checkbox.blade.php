@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group">
    <div class="form-check">
        <input {{ $attributes->whereStartsWith('data') }}
            name="{{$inputName}}"
            class="{{ $inputClass }} @error($inputValidationID) is-invalid @enderror"
            {{ $isChecked }}
            type="{{$inputType}}"
            value="{{$inputValue}}"
            id="{{ $inputID }}"
            {{$inputRequired}}
            >
        {{ $slot }}
    </div>
    @error($inputValidationID)
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>