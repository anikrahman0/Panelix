<?php
namespace App\Services\Admin;


use App\Models\Role;
use App\Models\RolePermission;
use App\Models\PermissionGroup;
use App\Http\Requests\RoleValidationRequest;

class RoleCrudService
{
    public static function listRoles()
    {
        $data['roles'] = Role::where('status', 1)->get();

        return $data;
    }

    public static function addRole()
    {
        $permissionGroups = PermissionGroup::with('parentPermissions.children')->get();

        $data['adminPermissions'] = $permissionGroups->where('type', 1);

        $data['roleTypes'] = [
            ['id' => 1, 'title' => 'Admin'],
        ];

        return $data;
    }

    public static function storeRole(RoleValidationRequest $request)
    {
        $validated = $request->validated();

        // Create the Role
        $role = Role::create($validated);

        // Attach permissions if available
        if ($request->has('permission')) {
            $rolePermissions = [];

            foreach ($request->permission as $permissionId) {
                $rolePermissions[] = [
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ];
            }

            RolePermission::insert($rolePermissions);
        }

        return [
            'success' => true,
            'message' => 'Role Created Successfully',
        ];
    }

    public static function editRole($id)
    {
        $role = Role::findOrFail($id);

        $data['role'] = $role;
        $data['selectedPermissions'] = RolePermission::where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();

        $permissionGroups = PermissionGroup::with('parentPermissions.children')->get();
        $data['adminPermissions'] = $permissionGroups->where('type', 1);

        $data['roleTypes'] = [
            ['id' => 1, 'title' => 'Admin'],
        ];

        return $data;
    }

    public static function updateRole(RoleValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $role = Role::findOrFail($id);
        $role->update($validated);

        if ($request->has('permission')) {
            // Get existing permissions
            $currentPermissions = $role->rolePermissions->pluck('permission_id')->toArray();

            // New permissions from request
            $newPermissions = $request->permission;

            // Delete removed permissions
            $permissionsToRemove = array_diff($currentPermissions, $newPermissions);
            if (!empty($permissionsToRemove)) {
                RolePermission::where('role_id', $role->id)
                    ->whereIn('permission_id', $permissionsToRemove)
                    ->delete();
            }

            // Add or update permissions
            foreach ($newPermissions as $permissionId) {
                $role->rolePermissions()->updateOrCreate(
                    ['permission_id' => $permissionId],
                    ['role_id' => $role->id, 'permission_id' => $permissionId]
                );
            }
        } else {
            // If no permissions provided, remove all
            RolePermission::where('role_id', $role->id)->delete();
        }

        return [
            'success' => true,
            'message' => 'Role Updated Successfully',
        ];
    }

    public static function deleteRole($id)
    {
        Role::where('id', $id)->update(['status' => 2]);

        return [
            'success' => true,
            'message' => 'Role deleted successfully',
        ];
    }
}
