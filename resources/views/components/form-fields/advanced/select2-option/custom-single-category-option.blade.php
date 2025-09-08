@foreach($options->where('parent_id', $parentID) as $option)
    <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">@for($i = 0; $i < $level; $i++) -&nbsp; @endfor{{$option[$optionLabelKey]}}</span></option>
    @if($options->where('parent_id', $option[$optionValueKey])->count()>0)
        <x-form-fields.advanced.select2-option.custom-single-category-option
            inputValue="{{$inputValue}}"
            :options="$options"
            optionValueKey="{{$optionValueKey}}"
            optionLabelKey="{{$optionLabelKey}}"
            parentID="{{$option[$optionValueKey]}}"
            level="{{$level+1}}" />
    @endif
@endforeach