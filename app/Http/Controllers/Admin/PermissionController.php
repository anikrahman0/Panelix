<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $groups = PermissionGroup::with(['permissions' => function($q) {
            $q->where('parent_id', 0)->with('children');
        }])->orderBy('id', 'desc')->paginate(20);

        return view('layouts.admin.dashboard.permissions.index', compact('groups'));
    }

    public function create()
    {
        return view('layouts.admin.dashboard.permissions.add');
    }
    public function store(Request $request)
    {
        $groups = $request->input('groups', []);

        foreach ($groups as $groupData) {
            if (empty($groupData['name'])) {
                continue;
            }

            // Check if the group already exists to prevent duplicates
            $group = PermissionGroup::firstOrCreate(
                ['name' => $groupData['name']],
                ['type' => 1, 'status' => 1]
            );

            // Now save permissions for this group
            foreach ($groupData['permissions'] ?? [] as $permData) {
                if (empty($permData['name'])) {
                    continue;
                }

                // Create main permission
                $permission = Permission::create([
                    'group_id'   => $group->id,
                    'parent_id'  => 0,
                    'name'       => $permData['name'],
                    'meta_name'  => $permData['name'],
                    'short_desc' => null,
                    'type'       => 1,
                    'status'     => 1
                ]);

                // Create sub-permissions
                foreach ($permData['sub_permissions'] ?? [] as $subName) {
                    if (empty($subName)) {
                        continue;
                    }

                    Permission::create([
                        'group_id'   => $group->id,
                        'parent_id'  => $permission->id,
                        'name'       => $subName,
                        'meta_name'  => $subName,
                        'short_desc' => null,
                        'type'       => 1,
                        'status'     => 1
                    ]);
                }
            }
        }

        // return response()->json(['success' => true]);
        return response()->json([
            'success' => true,
            'redirect' => route('admin.permissions.index'),
            'message' => 'Permissions created successfully.'
        ]);
    }

    public function edit($id)
    {
        $group = PermissionGroup::with(['permissions' => function ($q) {
            $q->where('parent_id', 0)->with('children');
        }])->findOrFail($id);

        return view('layouts.admin.dashboard.permissions.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = PermissionGroup::findOrFail($id);
        $group->name = $request->group_name;
        $group->save();

        $existingPermissionIds = [];
        $existingSubPermissionIds = [];

        foreach ($request->permissions as $permData) {
            if (empty($permData['name'])) {
                // Skip empty permission names
                continue;
            }

            if (!empty($permData['id'])) {
                // Update existing permission
                $permission = Permission::find($permData['id']);
                if ($permission) {
                    $permission->name = $permData['name'];
                    $permission->meta_name = $permData['name'];
                    $permission->save();
                    $existingPermissionIds[] = $permission->id;
                }
            } else {
                // Create new permission
                $permission = Permission::create([
                    'group_id' => $group->id,
                    'parent_id' => 0,
                    'name' => $permData['name'],
                    'meta_name' => $permData['name'],
                    'type' => 1,
                    'status' => 1
                ]);
                $existingPermissionIds[] = $permission->id;
            }

            // Now sub-permissions
            if (isset($permData['sub_permissions']) && is_array($permData['sub_permissions'])) {
                foreach ($permData['sub_permissions'] as $subData) {
                    if (empty($subData['name'])) {
                        // Skip empty sub-permission names
                        continue;
                    }

                    if (!empty($subData['id'])) {
                        $subPerm = Permission::find($subData['id']);
                        if ($subPerm) {
                            $subPerm->name = $subData['name'];
                            $subPerm->meta_name = $subData['name'];
                            $subPerm->save();
                            $existingSubPermissionIds[] = $subPerm->id;
                        }
                    } else {
                        $subPerm = Permission::create([
                            'group_id' => $group->id,
                            'parent_id' => $permission->id,
                            'name' => $subData['name'],
                            'meta_name' => $subData['name'],
                            'type' => 1,
                            'status' => 1
                        ]);
                        $existingSubPermissionIds[] = $subPerm->id;
                    }
                }
            }
        }

        // Delete removed permissions
        Permission::where('group_id', $group->id)
            ->where('parent_id', 0)
            ->whereNotIn('id', $existingPermissionIds)
            ->delete();

        // Delete removed sub-permissions
        Permission::where('group_id', $group->id)
            ->where('parent_id', '!=', 0)
            ->whereNotIn('id', $existingSubPermissionIds)
            ->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('admin.permissions.index'),
            'message' => 'Permissions updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $group = PermissionGroup::findOrFail($id);

        // Delete all permissions and their sub-permissions for this group
        Permission::where('group_id', $group->id)->delete();

        // Delete the permission group itself
        $group->delete();

        return back()->with('success', 'Permission deleted successfully.');
    }

}
