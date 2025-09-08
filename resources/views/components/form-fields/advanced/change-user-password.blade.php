<form method="POST" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="container-fluid">
        <div class="digital-add needs-validation">
            <div class="row">
                <div class="gap-3 col-md-9">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-body">
                                <div id="form-selected">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <x-form-fields.advanced.text-common
                                                inputType="password"
                                                inputName="password" 
                                                inputValue="{{ old('password') }}" 
                                                inputValidationID="password"
                                                inputRequired="required" 
                                                inputClass="form-control password input-group"
                                                labelText="Password"
                                                disabled=""
                                                maxlength="">
                                                <label for="password" class="form-label required">Password <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-4 gx-0 gy-0">
                                            <div class="input-group-append copy-section">
                                                <button class="btn btn-copy px-3 py-1" type="button" id="copyButton" title="Copy">
                                                    <i class="fa-regular fa-copy" id="copyPassword"></i>
                                                </button>
                                                <a href="javascript:void(0)" class="btn add-variant" id="generatePassword">Generate</a>
                                            </div>
                                            <span class="badge bg-copy text-success mt-2 px-3 py-1 d-none" id="copyMessage">Copied!</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <x-form-fields.advanced.text-common
                                                inputType="password"
                                                inputName="password_confirmation" 
                                                inputValue="{{ old('password_confirmation') }}" 
                                                inputValidationID="password_confirmation"
                                                inputRequired="required" 
                                                inputClass="form-control password_confirmation"
                                                labelText="Confirm Password"
                                                disabled=""
                                                maxlength="">
                                                <label for="password_confirmation" class="form-label required">Confirm Password <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <x-submission-card cardLabel="Publish" submitLabel="Update" discardLabel="Discard" />
                </div>
            </div>
        </div>
    </div>
</form>