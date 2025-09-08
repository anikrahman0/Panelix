@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group">
    {{ $slot }}
    <select style="width: 100%" {{ $attributes->whereStartsWith('data') }}
        name="{{$inputName}}"
        id="{{$inputID}}"
        class="{{$inputClass}} @error($inputValidationID) is-invalid @enderror"
        {{$inputRequired}}
        >
        @if(isset($labelText) && !empty($labelText))<option value="">{{$labelText}}</option>@endif
        @foreach($options as $option)
            <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
        @endforeach
    </select>
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>