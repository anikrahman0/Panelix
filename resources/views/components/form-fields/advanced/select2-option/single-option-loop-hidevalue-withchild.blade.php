@foreach($options as $option)
    @if($hideValue!=$option[$optionValueKey])
        <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">@for($i = 0; $i < $level; $i++) -&nbsp; @endfor{{$option[$optionLabelKey]}}</span></option>
        @if(count($option[$childname])>0)
            <x-form-fields.advanced.select2-option.single-option-loop-hidevalue-withchild
                inputValue="{{$inputValue}}"
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