<?php
namespace App\Services;

use App\Models\Book;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Wishlist;
use App\Library\CommonFunctions;
use App\Models\BookRatingReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function login($request){
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->status != 1) {
                return response()->json([
                    'errors' => [
                        'email' => 'Your account has been blocked.'
                    ]
                ], 422); // HTTP 403 Forbidden
            } else {
                if (Auth::attempt($credentials)) {
                    session()->put('last_password_change_' . $user->id, Auth::user()->password_changed_at);
                    return response()->json([
                        'success' => 'You are successfully logged in.',
                        'status' => 'success'
                    ]);
                }
            }
        } else {
            return response()->json([
                'errors' => [
                    'email' => 'Invalid credentials'
                ]
            ], 422); // HTTP 401 Unauthorized
        }

        return response()->json([
            'errors' => [
                'email' => 'The provided credentials do not match our records.'
            ]
        ], 422); // HTTP 422 Unprocessable Entity
    }

    public  function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function getProfileData()
    {
        $data = [];
        $data['countries'] = Country::orderBy('country_name', 'ASC')
            ->where('status', 1)
            ->get();

        $data['user'] = Auth::user();

        $data['selected_country'] = old('country_id', $data['user']->country_id);
        $data['selected_state'] = old('state_id', $data['user']->state_id);

        $data['states'] = State::orderBy('country_id', 'ASC')
            ->where('country_id', $data['selected_country'])
            ->where('status', 1)
            ->get();

        $data['cities'] = City::orderBy('state_id', 'ASC')
            ->where('state_id', $data['selected_state'])
            ->where('status', 1)
            ->get();

        return $data;
    }

    public  function updateProfile($request){
        $user = User::findOrFail(Auth::user()->id);
        $image = $request->file('image_path');
        if ($image != '') {
            $imagename = CommonFunctions::imageUpload($image, 'media/uploads/users');
            $user->image_path = $imagename;
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->zip = $request->zip_code;
        $user->address = $request->address;
        $user->save();
    }

    public  function updateUserPassword($request){

        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->password_changed_at = now();
        $user->save();
    }

    public function userWishlist(){
        $user = Auth::user();
        $data['wishlists'] = Wishlist::with('book')->where('status', 1)->where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(5);
        return $data;
    }

     public function saveWishlist($bookId)
    {
        if (!Auth::check()) {
            return ['status' => 'error', 'message' => 'Please log in to add to wishlist', 'code' => 401];
        }

        $book = Book::findOrFail($bookId);
        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', $user->id)->where('book_id', $book->id)->where('status', 1)->first();

        if ($wishlist) {
            $wishlist->delete();
            $count = Wishlist::where('user_id', $user->id)->count();

            return [
                'status' => 'removed',
                'message' => 'Book removed from your wishlist.',
                'count' => $count,
                'code' => 200
            ];
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => 1
            ]);

            $count = Wishlist::where('user_id', $user->id)->count();

            return [
                'status' => 'added',
                'message' => 'Book added to your wishlist.',
                'count' => $count,
                'code' => 200
            ];
        }
    }
    public function deleteWishlistItem($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return true;
    }

    public function bookReviewStore(array $data)
    {
        $review = BookRatingReview::create([
            'book_id' => $data['book_id'],
            'user_id' => Auth::id(),
            'user_rating' => $data['user_rating'],
            'comments' => $data['comments'],
        ]);

        return [
            'message' => 'Review submitted successfully.',
            'review' => $review,
            'status' => true,
        ];
    }

    public function getUserOrders()
    {
        $data['orders'] = Order::where('user_id', Auth::user()->id)->where('order_status', '!=', 8)->where('order_status', '!=', 6)->where('payment_status', '!=', 4)->where('payment_status', '!=', 5)->latest()->paginate(5);
        return $data;
    }
}
