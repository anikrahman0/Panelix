<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <select style="width: 100%" name="{{$inputName}}" id="{{$inputName}}" class="form-control form-select @error($inputName) is-invalid @enderror {{$inputName}}" {{$inputRequired=='true' ? 'required' : ''}} aria-required="{{$inputRequired}}">
        @if(isset($placeHolder) && !empty($placeHolder))<option value="">{{$placeHolder}}</option>@endif
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