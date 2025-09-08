@foreach($options as $option)
    <option value="{{$option[$optionValueKey]}}"><span class="boldCat">@for($i = 0; $i < $level; $i++) -&nbsp; @endfor{{$option[$optionLabelKey]}}</span></option>
    @if(count($option[$childname])>0)
        <x-form-fields.advanced.select2-option.multiple-option-loop-withchild
            :options="$option[$childname]"
            optionValueKey="{{$childValueKey}}"
            optionLabelKey="{{$childLabelKey}}"
            level="{{$level+1}}"
            childname="{{$childname}}"
            childValueKey="{{$childValueKey}}"
            childLabelKey="{{$childLabelKey}}" />
    @endif
@endforeach