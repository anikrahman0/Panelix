<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{   
    // facebook authentication
    public function authFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRedirect(){
        
        $user = Socialite::driver('facebook')->user();
        $userType = 'facebook';
        $this->authLogin($user, $userType);
        return to_route('user.dashboard');
    }

    //google authentication
    public function authGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect(){
        // $user = Socialite::driver('google')->stateless()->user();
        $user = Socialite::driver('google')->user();
        $userType = 'google';
        $this->authLogin($user, $userType);
        if(Session::has('already_registered') &&  Session::has('registered_email')){
            return redirect()->back()->with([ 'already_registered' => 'You are already registered. Login now', 'registered_email' => Session::get('registered_email')]);
        }
        return to_route('user.dashboard');
    }

    protected function authLogin($data, $type){
        if($type == 'facebook'){
           $check_user = User::where('email',$data->email)->whereIn('account_type', [1,2])->first();
           $check_fb_user = User::where('email', $data->email)->where('account_type', 3)->where('provider_id', $data->id)->first();
            if(!empty($check_user)){
                return redirect()->route('frontend.index')->with([
                    'already_registered' => 'You are already registered. Login now',
                    'registered_email' => $data->email,
                ]);
            }
            elseif(!empty($check_fb_user)){
                Auth::login($check_fb_user, true);
            }
            else{
                $user = new User;
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->image_path = $data->avatar;
                $user->account_type = 3;
                $user->password = null;
                $user->email_verified_at = now();
                $user->save();
                Auth::login($user);
            }   
       }else{
            $user = User::where('email',$data->email)->first();
            if(!empty($user)){
                if($user->account_type == 1){
                    return redirect()->back()->with([
                        'already_registered' => 'You are already registered. Login now',
                        'registered_email' => $data->email,
                    ]);
                }
                else{
                    Auth::login($user, true);
                }
            }else{
                $user = new User();
                $user->name = $data->name;
                $user->account_type = 2;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->image_path = $data->avatar;
                $user->password = null;
                $user->email_verified_at = now();
                $user->save();
                Auth::login($user, true);
            }
       }
    }
}
