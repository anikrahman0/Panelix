@foreach($options as $option)
    <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
@endforeach