<div class="row">
    <input type="hidden" name="user_type" value="1">
    <div class="col-xl-6">
        {{-- <x-form-fields.select inputName="role_id" inputValue="{{old('role_id',$user->role_id)}}" inputRequired="true" :options="$roles" optionValueKey="id" optionLabelKey="name" labelText="Role" /> --}}
    </div>
    
</div>
<div class="row">
    <div class="col-xl-4">
        <x-form-fields.dropify inputName="image_path" inputValue="" inputRequired="false" labelText="Profile Image <small>(Square. Preferable 150x150)</small>" height="80" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
    </div>
    <div class="col-xl-2">
        <div class="form-group">
            @if($imageExists)
                <x-profile-image src="{{asset($cdn_url.'/'.$user->image_path)}}" imgContainerClass="mt-3" width="110" height="110"/>
            @else
                <x-profile-image src="{{asset('assets/common/default-avatar.jpg')}}" imgContainerClass="" width="110" height="110"/>
            @endif
        </div>
    </div>
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id', $user->country_id)}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="name" inputValue="{{old('name') ?? $user->name }}" inputRequired="true" maxlength="100" inputType="text" labelText="Name" placeholder="" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="email" inputValue="{{old('email') ?? $user->email }}" inputRequired="true" maxlength="100" inputType="email" labelText="Email" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select inputName="gender" inputValue="{{old('gender', $user->gender)}}" inputRequired="true" :options="$gender" optionValueKey="id" optionLabelKey="type" labelText="Gender" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="phone" inputValue="{{old('phone') ?? $user->phone }}" inputRequired="false" maxlength="20" inputType="text" labelText="Phone" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.text-area inputName="address" inputValue="{{old('address') ?? $user->address}}" inputRequired="false" rows="4" cols="50" maxlength="255" inputType="text" labelText="Address" placeholder="" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.select inputName="status" inputValue="{{old('status',$user->status)}}" inputRequired="true" :options="$status" optionValueKey="id" optionLabelKey="type" labelText="Status" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6 option-area">
        <x-checkbox name="is_super" id="is_super" checkValue="1" isChecked="{{old('is_super',$user->is_super)==1 ? 'checked': ''}}" checkboxClass="mt-3" labelClass="bg-danger mt-3" labelText="Is Super" />
    </div>
</div>

