<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserCrudService;
use App\Http\Requests\UserValidationRequest;

class UserController extends Controller
{
    public function adminUsers()
    {
        $data = UserCrudService::listAdminUsers();

        return view('layouts.admin.dashboard.users.admin.index', $data);
    }
    
    public function users()
    {
        $data = UserCrudService::listCustomers();

        return view('layouts.admin.dashboard.users.customer.index', $data);
    }

    public function addUser()
    {
        $data = UserCrudService::addUser();

        return view('layouts.admin.dashboard.users.add', $data);
    }

    public function storeUser(UserValidationRequest $request)
    {
        $data = UserCrudService::storeUser($request);

        return to_route($data['redirect_route'])->with('success', $data['message']);
    }

    public function editAdminUser($id)
    {
        $data = UserCrudService::editAdminUser($id);

        return view('layouts.admin.dashboard.users.admin.edit', $data);
    }

    public function updateAdminUser(UserValidationRequest $request, $id)
    {
        $data = UserCrudService::updateAdminUser($request, $id);

        return to_route('admin.users.index-admin')->with('success', $data['message']);
    }

    public function editUser($id)
    {
        $data = UserCrudService::editCustomer($id);

        return view('layouts.admin.dashboard.users.customer.edit', $data);
    }

    public function updateUser(UserValidationRequest $request, $id)
    {
        $data = UserCrudService::updateCustomer($request, $id);

        return to_route('admin.users.index-user')->with('success', $data['message']);
    }

    public function deleteAdminUser($id)
    {
        $data = UserCrudService::deleteAdminUser($id);

        return to_route('admin.users.index-admin')->with('success', $data['message']);
    }

    public function deleteUser($id)
    {
        $data = UserCrudService::deleteCustomer($id);

        return to_route('admin.users.index-user')->with('success', $data['message']);
    }

    public function getCustomer(Request $request)
    {
        return response()->json(UserCrudService::getCustomer($request));
    }
    
    public function changeAdminPassword($id)
    {
        $data = UserCrudService::changeAdminPassword($id);

        return view('layouts.admin.dashboard.users.admin.change-password', $data);
    }

    public function updateAdminPassword(Request $request, $id)
    {
        $data = UserCrudService::updateAdminPassword($request, $id);

        return to_route('admin.users.index-admin')->with('success', $data['message']);
    }

    public function changeCustomerPassword($id)
    {
        $data = UserCrudService::changeCustomerPassword($id);

        return view('layouts.admin.dashboard.users.customer.change-password', $data);
    }

    public function updateCustomerPassword(Request $request, $id)
    {
        $data = UserCrudService::updateCustomerPassword($request, $id);

        return to_route('admin.users.index-user')->with('success', $data['message']);
    }

    public function editAdminProfile()
    {
        $data = UserCrudService::editAdminProfile();

        return view('layouts.admin.dashboard.users.admin.edit-profile', $data);
    }

    public function updateAdminProfile(Request $request)
    {
        $data = UserCrudService::updateAdminProfile($request);

        return to_route('admin.users.index-admin')->with('success', $data['message']);
    }
}