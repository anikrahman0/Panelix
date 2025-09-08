@php
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
@endphp
<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <select style="width: 100%" name="{{$inputName.$nameSuffix}}" class="form-control @error($inputName) is-invalid @enderror {{$inputName}}" {{$inputRequired=='true' ? 'required' : ''}} aria-required="{{$inputRequired}}">
        <option value="">Select {{$labelText}}</option>
        @foreach($options as $option)
            <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
        @endforeach
    </select>
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        $(".{{$inputName}}").select2({
            placeholder: "Select {{$labelText}}",
        });
    });
</script>
@endpush