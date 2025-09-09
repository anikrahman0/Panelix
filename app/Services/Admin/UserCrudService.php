<?php
namespace App\Services\Admin;


use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Library\CommonFunctions;
use App\Library\Traits\DiskTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserValidationRequest;

class UserCrudService
{
    use DiskTrait;

    public static function listAdminUsers()
    {
        $data['users'] = AdminUser::filter(request(['search']))
            ->with('role')
            ->latest()
            ->paginate(20);

        return $data;
    }

    public static function listCustomers()
    {
        $data['users'] = User::filter(request(['search']))
            ->with('role')
            ->latest()
            ->paginate(20);

        return $data;
    }

    public static function addUser()
    {
        $data['adminRoles'] = Role::where('type', 1)->get();

        $data['countries'] = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        $data['gender'] = [
            ['id' => 1, 'type' => 'Male'],
            ['id' => 2, 'type' => 'Female'],
            ['id' => 3, 'type' => 'Others'],
        ];

        $data['userType'] = [
            ['id' => 1, 'type' => 'Admin'],
            ['id' => 2, 'type' => 'Customer'],
        ];

        return $data;
    }

    public static function storeUser(UserValidationRequest $request)
    {
        $validated = $request->validated();

        switch ($validated['user_type']) {
            case 1:
                return self::createAdmin($validated, $request);
            case 2:
                return self::createCustomer($validated, $request);
            default:
                abort(400, 'Invalid user type');
        }
    }

    protected static function createAdmin($validated, $request)
    {
        $image = $request->file('image_path');
        if (!empty($image)) {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $validated['image_path'] = $imagename;
        }
        $validated['password'] = Hash::make($validated['password']);

        unset($validated['user_type'], $validated['password_confirmation']);

        AdminUser::create($validated);

        return [
            'success' => true,
            'message' => 'User Created Successfully',
            'redirect_route' => 'admin.users.index-admin',
        ];
    }

    protected static function createCustomer($validated, $request)
    {
        $image = $request->file('image_path');
        if (!empty($image)) {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $validated['image_path'] = $imagename;
        }
        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = Carbon::now();

        unset($validated['user_type'], $validated['password_confirmation']);

        User::create($validated);

        return [
            'success' => true,
            'message' => 'Customer Created Successfully',
            'redirect_route' => 'admin.users.index-user',
        ];
    }

    public static function editAdminUser($id)
    {
        $service = new self();
        $service->diskInitialize();

        $user = AdminUser::findOrFail($id);

        $countries = Country::orderBy('country_name', 'ASC')
            ->where('status', 1)
            ->get();

        $gender = [
            ['id' => 1, 'type' => 'Male'],
            ['id' => 2, 'type' => 'Female'],
            ['id' => 3, 'type' => 'Others'],
        ];

        $status = [
            ['id' => 1, 'type' => 'Active'],
            ['id' => 2, 'type' => 'Inactive'],
        ];

        $imagePath = $user->image_path;
        $imageExists = !empty($imagePath) && $service->diskStorage->exists($imagePath);

        return [
            'user' => $user,
            'countries' => $countries,
            'gender' => $gender,
            'status' => $status,
            'imageExists' => $imageExists,
        ];
    }

    public static function updateAdminUser(UserValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $user = AdminUser::findOrFail($id);

        $image = $request->file('image_path');
        if (!empty($image)) {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $validated['image_path'] = $imagename;
        }

        $validated['is_super'] = $request->has('is_super') ? $request->input('is_super') : 2;

        unset($validated['user_type']);

        $user->update($validated);

        return [
            'success' => true,
            'message' => 'User Updated Successfully',
        ];
    }

    public static function editCustomer($id)
    {
        $service = new self();
        $service->diskInitialize();

        $user = User::findOrFail($id);
        // dd($user);

        $countries = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        $states = State::where('country_id', $user->country_id)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        $cities = City::where('state_id', $user->state_id)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        $gender = [
            ['id' => 1, 'type' => 'Male'],
            ['id' => 2, 'type' => 'Female'],
            ['id' => 3, 'type' => 'Others'],
        ];

        $status = [
            ['id' => 1, 'type' => 'Active'],
            ['id' => 2, 'type' => 'Inactive'],
        ];

        $imagePath = $user->image_path;
        $imageExists = !empty($imagePath) && $service->diskStorage->exists($imagePath);

        return [
            'user' => $user,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'gender' => $gender,
            'status' => $status,
            'imageExists' => $imageExists,
        ];
    }

    public static function updateCustomer(UserValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);

        $image = $request->file('image_path');
        if (!empty($image)) {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $validated['image_path'] = $imagename;
        }

        unset($validated['user_type']);

        $user->update($validated);

        return [
            'success' => true,
            'message' => 'Customer Updated Successfully',
        ];
    }

    public static function deleteAdminUser($id)
    {
        $user = AdminUser::findOrFail($id);
        $user->update(['status' => 2]);

        return [
            'success' => true,
            'message' => 'User Deleted Successfully',
        ];
    }

    public static function deleteCustomer($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 2]);

        return [
            'success' => true,
            'message' => 'Customer Deleted Successfully',
        ];
    }

    public static function getCustomer(Request $request)
    {
        $term = $request->input('term', '');

        $customers = User::where('status', 1)
            ->where('name', 'like', '%' . $term . '%')
            ->get(['id as id', 'name as text']);

        return ['results' => $customers];
    }

    public static function changeAdminPassword($id)
    {
        $user = AdminUser::findOrFail($id);

        return ['user' => $user];
    }

    public static function updateAdminPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|max:50',
            'password_confirmation' => 'same:password'
        ]);

        $user = AdminUser::findOrFail($id);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return [
            'success' => true,
            'message' => 'Admin Password Updated Successfully',
        ];
    }

    public static function changeCustomerPassword($id)
    {
        $user = User::findOrFail($id);

        return ['user' => $user];
    }

    public static function updateCustomerPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|max:50',
            'password_confirmation' => 'same:password'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return [
            'success' => true,
            'message' => 'User Password Updated Successfully',
        ];
    }

    public static function editAdminProfile()
    {
        $service = new self();
        $service->diskInitialize();

        $id = Auth::guard('admin')->user()->id;
        $user = AdminUser::findOrFail($id);

        $countries = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        $gender = [
            ['id' => 1, 'type' => 'Male'],
            ['id' => 2, 'type' => 'Female'],
            ['id' => 3, 'type' => 'Others'],
        ];

        $imagePath = $user->image_path;
        $imageExists = !empty($imagePath) && $service->diskStorage->exists($imagePath);

        return [
            'user' => $user,
            'countries' => $countries,
            'gender' => $gender,
            'imageExists' => $imageExists,
        ];
    }

    public static function updateAdminProfile(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;

        $emailRule = [
            'required',
            'email',
            'max:100',
            Rule::unique('admin_users', 'email')
                ->ignore($id)
                ->where(fn($query) => $query->where('status', 1))
        ];

        $phoneRule = [
            'nullable',
            'string',
            'max:20',
            Rule::unique('admin_users', 'phone')
                ->ignore($id)
                ->where(fn($query) => $query->where('status', 1))
        ];

        $validated = $request->validate([
            'country_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'gender' => 'required|in:1,2,3',
            'phone' => $phoneRule,
            'address' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ]);

        $user = AdminUser::findOrFail($id);

        $image = $request->file('image_path');
        if (!empty($image)) {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $user->image_path = $imagename;
        }

        $user->country_id = $validated['country_id'];
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->gender = $validated['gender'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        $user->update();

        return [
            'success' => true,
            'message' => 'Profile Updated Successfully',
        ];
    }
}
