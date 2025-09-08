<div class="row">
    <div class="col-xl-6">
        <x-form-fields.select inputName="role_id" inputValue="{{old('role_id')}}" inputRequired="true" :options="$roles" optionValueKey="id" optionLabelKey="name" labelText="Role" />
    </div>
    <div class="col-xl-6 option-area">
        <x-checkbox name="is_super" id="is_super" checkValue="1" isChecked="{{old('is_super')==1 ? 'checked': ''}}" checkboxClass="mt-3" labelClass="bg-danger mt-3" labelText="Is Super" />
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <x-form-fields.dropify inputName="image_path" inputValue="" inputRequired="false" labelText="Profile Image <small>(Square. Preferable 150x150)</small>" height="80" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id')}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" />
    </div>  
</div>
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
<x-form-fields.text-area inputName="address" inputValue="{{old('address')}}" inputRequired="false" rows="4" cols="50" maxlength="255" inputType="text" labelText="Address" placeholder="" />
{{-- <div class="row">
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="password" inputValue="" inputRequired="true" maxlength="100" inputType="password" labelText="Password" placeholder="" />
    </div>
    <div class="col-xl-6">
        <x-form-fields.text-common inputName="password_confirmation" inputValue="" inputRequired="true" maxlength="100" inputType="password" labelText="Confirm Password" placeholder="" />
    </div>
</div> --}}
<div class="row">
    <div class="col-xl-6">
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

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#country_id').select2({
            placeholder: 'Select Country'
        });
        $(document).on('change', '#country_id', function () {
            var selectedData = $(this).select2('data'); // Get an array of selected data items
            console.log(selectedData);
            $.ajax({
                url: "{{route('admin.cities.states')}}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    'country_id': selectedData[0].id
                },
                success: function (response) {
                    console.log(response);
                    let data = [{id: '', text: 'Select State'}];
                    (response.states).forEach(element => {
                        data.push({id: element.id, text: element.name})
                    });

                    $('#state_id').empty();
                    $('#state_id').select2({
                        data: data,
                        placeholder: 'Select State'
                    });
                }
            });
        });
    });
</script>
@endpush