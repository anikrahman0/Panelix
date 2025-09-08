@foreach($options as $option)
    <option value="{{$option[$optionValueKey]}}"><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
@endforeach