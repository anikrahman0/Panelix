@extends('layouts.admin.base.app')
@section('title', 'Edit Permission')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Edit Permission" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.permissions.index') }}" label="Permissions" icon="key" />
                                <x-breadcrumb-item active="true" label="Edit Permission" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <div class="container-fluid">
        <div class="card mb-3">
            <div class="form-body">
                <div class="card-body">
                    <div id="permission-groups">
                        <div class="permission-group border p-3 mt-3">
                            <span class="fw-bold mb-2">Permission Group</span>
                            <input type="text" class="form-control mb-3 group-name permission-common" value="{{ $group->name }}" required>
                            <div class="permissions">
                                @foreach($group->permissions as $permission)
                                <div class="permission border p-3 mt-2 mb-4 ms-3" data-id="{{ $permission->id }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold mb-2 mt-2">Permission</span>
                                        <button type="button" class="btn btn-transparent remove-permission px-1 py-1 cs-size"><i class="fa-solid fa-circle-xmark text-danger"></i></button>
                                    </div>
                                    <input type="text" class="form-control mb-2 permission-name permission-common" value="{{ $permission->name }}" required>
                                    <div class="sub-permissions">
                                        @foreach($permission->children as $sub)
                                        <div class="sub-permission mt-1 ms-3 mb-2" data-id="{{ $sub->id }}">
                                            <span class="fw-bold mb-2 mt-2 label-sub-per">Sub Permission Name</span>
                                            <div class="d-flex">
                                                <input type="text" class="form-control sub-permission-name permission-common" value="{{ $sub->name }}" required>
                                                <button type="button" class="btn bg-light border btn-sm ms-2 remove-sub-permission px-3 py-1"><i class="fa-solid fa-trash-can text-danger"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm text-dark border add-sub-permission mt-3 btn-pad-cus"><i class="fa-solid fa-plus"></i> Add Sub</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm add-permission mt-3 ms-3 btn-pad-cus"><i class="fa-solid fa-plus"></i> Add Permission</button>
                        </div>
                    </div>
                    <br><br>
                    <button type="button" id="update-permissions" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Templates --}}
    <div id="group-template" style="display:none;">
        <div class="permission-group border p-3 mt-3">
            <span class="fw-bold mb-2">Permission Group</span>
            <input type="text" class="form-control mb-2 group-name" name="group_name" placeholder="Permission Group Name" required>
            <div class="permissions"></div>
            <button type="button" class="btn btn-secondary btn-sm add-permission mt-3"><i class="fa-solid fa-plus"></i> Add Permission</button>
        </div>
    </div>

    <div id="permission-template" style="display:none;">
        <div class="permission border p-3 mt-2 mb-4 ms-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold mb-2 mt-2">Permission</span>
                <button type="button" class="btn btn-transparent remove-permission px-1 py-1 cs-size"><i class="fa-solid fa-circle-xmark text-danger"></i></button>
            </div>
            <input type="text" class="form-control mb-2 permission-name permission-common" name="permission_name" placeholder="Permission Name" required>
            <div class="sub-permissions"></div>
            <button type="button" class="btn btn-sm text-dark border add-sub-permission mt-3 btn-pad-cus"><i class="fa-solid fa-plus"></i> Add Sub</button>
        </div>
    </div>

    <div id="sub-permission-template" style="display:none;">
        <div class="sub-permission mt-1 ms-3 mb-2">
            <span class="fw-bold mb-2 mt-2 label-sub-per">Sub Permission Name</span>
            <div class="d-flex">
                <input type="text" class="form-control sub-permission-name permission-common" name="sub_permission_name" placeholder="" required>
                <button type="button" class="btn bg-light border btn-sm ms-2 remove-sub-permission px-3 py-1"><i class="fa-solid fa-trash-can text-danger"></i></button>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    $(document).ready(function () {
        // Add group
        $('#add-group').on('click', function () {
            $('#permission-groups').append($('#group-template').html());
            $('#save-permissions').removeClass('d-none');
        });

        // Remove group
        $(document).on('click', '.remove-group', function () {
            $(this).closest('.permission-group').remove();
            $('#save-permissions').addClass('d-none');
        });

        // Add permission
        $(document).on('click', '.add-permission', function () {
            $(this).closest('.permission-group').find('.permissions').append($('#permission-template').html());
        });

        // Remove permission
        $(document).on('click', '.remove-permission', function () {
            $(this).closest('.permission').remove();
        });

        // Add sub-permission
        $(document).on('click', '.add-sub-permission', function () {
            $(this).closest('.permission').find('.sub-permissions').append($('#sub-permission-template').html());
        });

        // Remove sub-permission
        $(document).on('click', '.remove-sub-permission', function () {
            $(this).closest('.sub-permission').remove();
        });

        $('#update-permissions').on('click', function () {
            let permissions = [];
            $('.permission').each(function () {
                let perm = {
                    id: $(this).data('id') || null,
                    name: $(this).find('.permission-name').val().trim(),
                    sub_permissions: []
                };
                $(this).find('.sub-permission').each(function () {
                    perm.sub_permissions.push({
                        id: $(this).data('id') || null,
                        name: $(this).find('.sub-permission-name').val().trim()
                    });
                });
                permissions.push(perm);
            });

            $.ajax({
                url: "{{ route('admin.permissions.update', $group->id) }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    group_name: $('.group-name').val().trim(),
                    permissions: permissions
                },
                success: function (res) {
                    if (res.success) {
                        console.log(res.message);
                        window.location.href = res.redirect;
                    } else {
                        console.log('Error saving permissions');
                    }
                },
                error: function (err) {
                    console.error(err);
                    console.log('Something went wrong.');
                }
            });
        });
    });
</script>
@endpush
