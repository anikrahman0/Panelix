@php
    $inputID = str_replace('.', '_', $inputValidationID);
@endphp
<div class="form-group @error($inputValidationID) is-invalid @enderror">
    {{ $slot }}
    <input {{ $attributes->whereStartsWith('data') }}
        type="file"
        class="{{$inputClass}}"
        id="{{$inputID}}"
        name="{{$inputName}}"
        {{$inputRequired}}
        data-max-file-size-preview="{{$maxSize}}"
        data-height="{{$height}}"
        data-allowed-file-extensions="{{$extentions}}"
        data-max-file-size="{{$maxSize}}"
        data-errors-position="outside"
        accept="{{$accepts}}"
        {{$multiple=='true' ? 'multiple' : ''}}
        data-default-file="{{ !empty($inputValue) ? $inputValue : '' }}"
        >
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        if(!"{{$inputID}}".includes("$")){
            $("#{{$inputID}}").dropify();
        }
    });
</script>
@endpush