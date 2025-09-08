<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\LocationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ReviewSubmitRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    protected $userService;
    protected $locationService;
    
    public  function __construct(UserService $userService, LocationService $locationService)
    {
        $this->userService = $userService;
        $this->locationService = $locationService;
    }
    public function dashboard()
    {
        return view('layouts.user.dashboard');
    }

    public function profile()
    {
        $data = $this->userService->getProfileData();
        return view('layouts.user.profile', $data);
    }

    public  function userProfileUpdate(UpdateUserRequest $request){
        $this->userService->updateProfile($request);
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function orders()
    {
        $orders = $this->userService->getUserOrders();
        return view('layouts.user.orders', $orders);
    }

    public function orderDetails($id)
    {
        $data['order'] = Order::with('items.book', 'orderShippingAddress', 'user')
            ->where('order_status', '!=', 8)
            ->where('order_status', '!=', 6)
            ->where('payment_status', '!=', 4)
            ->where('payment_status', '!=', 5)->findOrFail($id);
        if (!$data['order']) {
            throw new \Exception('Order not found');
        }
        return view('common.order-invoice', $data);
    }

    public function changePassword()
    {
        return view('layouts.user.change-password');
    }

    public function updateUserPassword(ChangePasswordRequest $request)
    {
        $this->userService->updateUserPassword($request);
        return redirect()->route('user.change.password')->with('success', 'Password updated successfully.');
    }

    public function wishlist(){
        $wishlists = $this->userService->userWishlist();
        return view('layouts.user.wishlist', $wishlists);
    }
    public function wishlistUpdate(Request $request){
        $response = $this->userService->saveWishlist($request->book_id);

        return response()->json([
            'status' => $response['status'],
            'message' => $response['message'],
            'count' => $response['count'] ?? null
        ], $response['code']);
    }
    
    public function wishlistDelete($id) {
        $this->userService->deleteWishlistItem($id);
        return redirect()->back()->with('success', 'Item removed from your wishlist');
    }

    public function reviewStoreOrUpdate(ReviewSubmitRequest $request)
    {
        $response = $this->userService->bookReviewStore($request->validated());

        return response()->json($response);
    }

    public function getStatesAjax(Request $request, LocationService $locationService)
    {
        $states = $locationService->getStatesByCountry($request->country_id);

        if ($states->isNotEmpty()) {
            return response()->json(['status' => 'success', 'states' => $states]);
        }

        return response()->json(['status' => 'error', 'states' => []]);
    }

    public function getCitiesAjax(Request $request, LocationService $locationService)
    {
        $cities = $locationService->getCitiesByState($request->state_id);

        if ($cities->isNotEmpty()) {
            return response()->json(['status' => 'success', 'cities' => $cities]);
        }

        return response()->json(['status' => 'error', 'cities' => []]);
    }
}
