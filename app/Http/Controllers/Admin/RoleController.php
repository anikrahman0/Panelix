<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\RoleCrudService;
use App\Http\Requests\RoleValidationRequest;

class RoleController extends Controller
{
    public function index()
    {
        $data = RoleCrudService::listRoles();

        return view('layouts.admin.dashboard.users.roles.index', $data);
    }

    public function create()
    {
        $data = RoleCrudService::addRole();

        return view('layouts.admin.dashboard.users.roles.add', $data);
    }

    public function store(RoleValidationRequest $request)
    {
        $data = RoleCrudService::storeRole($request);

        return to_route('admin.roles.index')->with('success', $data['message']);
    }

    public function edit($id)
    {
        $data = RoleCrudService::editRole($id);

        return view('layouts.admin.dashboard.users.roles.edit', $data);
    }

    public function update(RoleValidationRequest $request, $id)
    {
        $data = RoleCrudService::updateRole($request, $id);

        return to_route('admin.roles.index')->with('success', $data['message']);
    }

    public function destroy($id)
    {
        $data = RoleCrudService::deleteRole($id);

        return back()->with('success', $data['message']);
    }
}
