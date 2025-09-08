<div class="row">
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="name" inputValue="{{old('name')}}" inputRequired="true" maxlength="100" inputType="text" labelText="Name" placeholder="" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="email" inputValue="{{old('email')}}" inputRequired="true" maxlength="100" inputType="email" labelText="Email" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select inputName="gender" inputValue="{{old('gender')}}" inputRequired="true" :options="$gender" optionValueKey="id" optionLabelKey="type" labelText="Gender" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="phone" inputValue="{{old('phone')}}" inputRequired="false" maxlength="20" inputType="text" labelText="Phone" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id')}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="state_id" inputValue="{{old('state_id')}}" inputRequired="true" :options="[]" optionValueKey="id" optionLabelKey="name" labelText="State" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="city_id" inputValue="{{old('city_id')}}" inputRequired="true" :options="[]" optionValueKey="id" optionLabelKey="name" labelText="City" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="zip" inputValue="{{old('zip')}}" inputRequired="false" maxlength="10" inputType="text" labelText="Zip" placeholder="" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.text-area inputName="address" inputValue="{{old('address')}}" inputRequired="false" rows="4" cols="50" maxlength="255" inputType="text" labelText="Address" placeholder="" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.dropify inputName="image_path" inputValue="" inputRequired="false" labelText="Profile Image <small>(Square. Preferable 150x150)</small>" height="80" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        {{-- <x-form-fields.text-common inputName="password" inputValue="" inputRequired="true" maxlength="100" inputType="password" labelText="Password" placeholder="" /> --}}
        <x-form-fields.advanced.text-common
            inputType="password"
            inputName="password" 
            inputValue="{{ old('password') }}" 
            inputValidationID="password"
            inputRequired="required" 
            inputClass="form-control password input-group"
            labelText="Password"
            disabled=""
            maxlength="100">
            <label for="password" class="form-label required">Password <span>*</span></label>
        </x-form-fields.advanced.text-common>
    </div>
    <div class="col-sm-4 gx-0 gy-0">
        <div class="input-group-append copy-section">
            <button class="btn btn-copy px-3 py-1" type="button" id="copyButton" title="Copy" style="display: none;">
                <i class="fa-regular fa-copy" id="copyPassword"></i>
            </button>
            <a href="javascript:void(0)" class="btn add-variant" id="generatePassword">Generate</a>
            <span class="badge bg-copy text-success mt-2 px-3 py-1 d-none" id="copyMessage">Copied!</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        {{-- <x-form-fields.text-common inputName="password_confirmation" inputValue="" inputRequired="true" maxlength="100" inputType="password" labelText="Confirm Password" placeholder="" /> --}}
        <x-form-fields.advanced.text-common
            inputType="password"
            inputName="password_confirmation" 
            inputValue="{{ old('password_confirmation') }}" 
            inputValidationID="password_confirmation"
            inputRequired="required" 
            inputClass="form-control password_confirmation"
            labelText="Confirm Password"
            disabled=""
            maxlength="100">
            <label for="password_confirmation" class="form-label required">Confirm Password <span>*</span></label>
        </x-form-fields.advanced.text-common>
    </div>
</div>