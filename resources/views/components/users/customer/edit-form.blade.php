<div class="row">
    <input type="hidden" name="user_type" value="2">
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
        <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id', $user->country_id)}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="state_id" inputValue="{{old('state_id', $user->state_id)}}" inputRequired="true" :options="$states" optionValueKey="id" optionLabelKey="name" labelText="State" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="city_id" inputValue="{{old('city_id', $user->city_id)}}" inputRequired="true" :options="$cities" optionValueKey="id" optionLabelKey="name" labelText="City" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="zip" inputValue="{{old('zip') ?? $user->zip }}" inputRequired="false" maxlength="10" inputType="text" labelText="Zip" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <x-form-fields.text-area inputName="address" inputValue="{{old('address') ?? $user->address}}" inputRequired="false" rows="4" cols="50" maxlength="255" inputType="text" labelText="Address" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-5">
        <x-form-fields.dropify inputName="image_path" inputValue="" inputRequired="false" labelText="Profile Image <small>(Square. Preferable 150x150)</small>" height="80" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
    </div>
    <div class="col-xl-2">
        {{-- @dd($cdn_url.'/'.$user->image_path) --}}
        @if($imageExists)
            <x-profile-image src="{{ $cdn_url.'/'.$user->image_path }}" imgContainerClass="mt-3" width="150" height="150"/>
        @else
            <x-profile-image src="{{asset('assets/common/default-avatar.jpg')}}" imgContainerClass=""  width="110" height="110"/>
        @endif
    </div>
    <div class="col-xl-5">
        <x-form-fields.select inputName="status" inputValue="{{old('status',$user->status)}}" inputRequired="true" :options="$status" optionValueKey="id" optionLabelKey="type" labelText="Status" />
    </div>
</div>
