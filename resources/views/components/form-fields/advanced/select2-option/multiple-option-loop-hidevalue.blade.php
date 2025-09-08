@foreach($options as $option)
    @if($hideValue!=$option[$optionValueKey])
        <option value="{{$option[$optionValueKey]}}"><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
    @endif
@endforeach