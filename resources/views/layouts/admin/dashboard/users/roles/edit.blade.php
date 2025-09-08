@extends('layouts.admin.base.app')
@section('title', 'Update Role')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update Role" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.roles.index') }}" label="Roles" />
                                <x-breadcrumb-item active="true" label="Update Role" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('admin.roles.update', $role->id)}}">
        @csrf
        @method('PATCH')
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9">
                    <div class="digital-add needs-validation">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <x-form-fields.text-common inputType="text" inputName="name" inputValue="{{old('name') ?? $role->name}}" inputRequired="true" labelText="Name" placeHolder="Name" pattern="" maxlength="100" />
                                        </div>
                                        <div class="col-xl-6">
                                            <x-form-fields.select inputName="type" inputValue="{{old('type', $role->type)}}" inputRequired="true" :options="$roleTypes" optionValueKey="id" optionLabelKey="title" labelText="Role Type" placeHolder="" />
                                        </div>
                                        <div class="col-xl-12">
                                            <x-form-fields.text-area inputName="short_desc" inputValue="{{old('short_desc') ?? $role->short_desc}}" inputRequired="false" labelText="Short Description" rows="4" cols="50" maxlength="255" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-adding">
                        <div class="card permission-card">
                            <div class="card-header">
                                <h5 class="card-title">Permission Flags</h5>
                                <div class="card-actions card-header-right">
                                    <x-form-fields.radio-checkbox inputName="" inputID="allTreeChecked" inputType="checkbox" inputValue="" inputClass="form-check-input allTree me-3 permission-common permission-all" inputRequired="false" labelClass="badge" labelText="All Permissions" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="permission-section">
                                    <div class="permission-container admin-permission {{$role->type != 1 ? 'd-none' : '' }}">
                                        <x-users.roles.role-permission-area :permissions="$adminPermissions" :selected="$selectedPermissions" />
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
    </form>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        permissionInitCheck()

        $('.type').change(function() {
            var type = $(this).val();
            $('.permission-common').prop('checked',false)
            if(type==1){
                $('.admin-permission').removeClass('d-none')
            }else{
                $('.admin-permission').addClass('d-none')
            }
        });

        $(document).on('change', '.permission-all', function () {
            var isChecked = $(this).is(':checked');
            $(this).parents('.permission-card').find('#permission-section .permission-container:not(.d-none) .permission-common').prop('checked', isChecked);
        });

        $(document).on('change', '.permission-group', function () {
            var isChecked = $(this).is(':checked');
            $(this).parents('.permission-area').find('.option-area .permission-common').prop('checked', isChecked);

            permissionGroupCheck($(this))
        });

        $(document).on('change', '.permission-parent', function () {
            var isChecked = $(this).is(':checked');
            $(this).parents('.accordion-item').find('.accordion-body .permission-common').prop('checked', isChecked);

            permissionParentCheck($(this))
        });

        $(document).on('change', '.permission-child', function () {
            var isChecked = $(this).is(':checked');

            permissionChildCheck($(this))
        });
    });

    function permissionInitCheck() {
        let checkAll = true;

        $('.permission-card #permission-section .permission-container:not(.d-none) .permission-area').each(function( index ) {
            let checkGroup = true;
            $(this).find('.permission-parent').each(function( index ) {
                if(!$(this).is(':checked')){
                    checkGroup=false
                }
            });
            if(checkGroup){
                $(this).find('.permission-group').prop('checked', checkGroup);
            }

            if(!$(this).find('.permission-group').is(':checked')){
                checkAll=false
            }
        });
        if(checkAll){
            $('.permission-card .permission-all').prop('checked', checkAll);
        }
    }
    function permissionGroupCheck(elem) {
        let checkAll = true;
        elem.parents('.permission-container').find('.permission-group').each(function( index ) {
            if(!$(this).is(':checked')){
                checkAll=false
            }
        });
        if(elem.parents('.permission-card').find('.card-header .permission-all').is(':checked') != checkAll){
            elem.parents('.permission-card').find('.card-header .permission-all').prop('checked', checkAll);
        }
        return true
    }
    function permissionParentCheck(elem) {
        let checkGroup = true;
        elem.parents('.option-area').find('.permission-parent').each(function( index ) {
            if(!$(this).is(':checked')){
                checkGroup=false
            }
        });
        if(elem.parents('.permission-area').find('.badge-area .permission-group').is(':checked') != checkGroup){
            elem.parents('.permission-area').find('.badge-area .permission-group').prop('checked', checkGroup);
            permissionGroupCheck(elem)
        }
        return true
    }
    function permissionChildCheck(elem) {
        let checkParent = true;
        elem.parents('.accordion-body').find('.permission-child').each(function( index ) {
            if(!$(this).is(':checked')){
                checkParent=false
            }
        });
        if(elem.parents('.accordion-item').find('.permission-parent').is(':checked') != checkParent){
            elem.parents('.accordion-item').find('.permission-parent').prop('checked', checkParent);
            permissionParentCheck(elem)
        }
        return true
    }
</script>
@endpush