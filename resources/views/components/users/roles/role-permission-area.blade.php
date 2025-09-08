@foreach($permissions as $group)
<div class="permission-area">
    <div class="badge-area">
        <x-form-fields.radio-checkbox inputName="" inputID="section-{{$group->id}}" inputType="checkbox" inputValue="" inputClass="form-check-input permission-common permission-group" inputRequired="false" labelClass="badge" labelText="{{$group->name}}" />
        {{-- <x-checkbox name="" checkValue="" id="section-{{$group->id}}" checkboxClass="permission-common permission-group" labelClass="bg-danger" labelText="{{$group->name}}"/> --}}
    </div>
    <div class="option-area">
        <div class="row">
            <div class="col-md-12">
                <ul class="d-flex">
                    @foreach($group->parentPermissions as $permission)
                    <li>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header d-flex align-items-center" id="panelsStayOpen-headingOne">
                                    <x-form-fields.radio-checkbox inputName="permission[]" inputID="permission-parent-{{$permission->id}}-type-{{$group->type}}" isChecked="{{(isset($selected) && in_array($permission->id, $selected)) ? 'checked': ''}}" inputType="checkbox" inputValue="{{$permission->id}}" inputClass="form-check-input permission-common permission-parent" inputRequired="false" labelClass="badge" labelText="{{$permission->name}}" />
                                    {{-- <x-checkbox name="permission[]" id="permission-parent-{{$permission->id}}" checkValue="{{$permission->id}}" checkboxClass="permission-common permission-parent" labelClass="bg-danger" labelText="{{$permission->name}}" /> --}}
                                </h2>
                                <div id="panelsStayOpen-pages" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne" data-bs-parent="#panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        @foreach ($permission->children as $child)
                                            <x-form-fields.radio-checkbox inputName="permission[]" inputID="child-permission-{{$child->meta_name}}-type-{{$group->type}}" isChecked="{{(isset($selected) && in_array($child->id, $selected)) ? 'checked': ''}}" inputType="checkbox" inputValue="{{$child->id}}" inputClass="form-check-input permission-common permission-child" inputRequired="false" labelClass="badge" labelText="{{$child->name}}" />
                                            {{-- <x-checkbox name="permission[]" checkValue="{{$child->id}}" id="child-permission-{{$child->meta_name}}" checkboxClass="permission-common permission-child" labelClass="bg-danger" labelText="{{$child->name}}" /> --}}
                                        @endforeach
                                    </div>
                                </div>
                            </div>                                                
                        </div>                                                
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach