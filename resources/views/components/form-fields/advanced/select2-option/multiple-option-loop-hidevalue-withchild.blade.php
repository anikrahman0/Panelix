@foreach($options as $option)
    @if($hideValue!=$option[$optionValueKey])
        <option value="{{$option[$optionValueKey]}}"><span class="boldCat">@for($i = 0; $i < $level; $i++) -&nbsp; @endfor{{$option[$optionLabelKey]}}</span></option>
        @if(count($option[$childname])>0)
            <x-form-fields.advanced.select2-option.multiple-option-loop-hidevalue-withchild
                :options="$option[$childname]"
                optionValueKey="{{$childValueKey}}"
                optionLabelKey="{{$childLabelKey}}"
                level="{{$level+1}}"
                childname="{{$childname}}"
                childValueKey="{{$childValueKey}}"
                childLabelKey="{{$childLabelKey}}"
                hideValue="{{$hideValue}}" />
        @endif
    @endif
@endforeach