@foreach($options as $option)
    @if($hideValue!=$option[$optionValueKey])
        <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
    @endif
@endforeach