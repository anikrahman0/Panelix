<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class EmailVerificationController extends Controller
{
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? $this->redirectAfterVerified()
            : view('layouts.user.auth.verify');
    }
    public function verify($user_id, $token){
        $user = User::where('id',$user_id);
        $checkUser = $user->first();
        if(!empty($checkUser)){
            if($checkUser->email_verified_at == null){
                $verifyToken = $user->where('email_verify_token',$token)->first();
                if(!empty($verifyToken)){
                    $expirationTime = $verifyToken->email_token_expire;
                    $expirationTime += 3600;
                    $currentTime = time();
                    if($currentTime < $expirationTime){
                        $checkUser->email_verified_at = now();
                        $checkUser->email_verify_token = '';
                        $checkUser->update();
                        return to_route('email.verify.success')->with('show')->with('verify-success','Your email has been verified successfully.');
                    }
                }
                return to_route('email.verify.success')->with('show')->with('error','Invalid Token or Expired');
            }elseif($checkUser->email_verified_at != null){
                $verifyToken = $user->where('email_verify_token',$token)->first();
                if(!empty($verifyToken)){
                    $expirationTime = $verifyToken->email_token_expire;
                    $expirationTime += 3600;
                    $currentTime = time();
                    if($currentTime < $expirationTime){
                        $checkUser->email_verified_at = now();
                        $checkUser->email_verify_token = '';
                        $checkUser->email = $checkUser->alternate_email;
                        $checkUser->alternate_email = '';
                        $checkUser->update();
                        return to_route('email.verify.success')->with('show')->with('verify-success','Your email has been verified successfully.');
                    }
                }
                return to_route('email.verify.success')->with('show')->with('error','Invalid Token or Expired');
            }
            return to_route('email.verify.success')->with('show')->with('verify-success','Your email already verified.');
        }
        return redirect()->route('email.verify.show')->with('show')->with('error', 'Invalid User');
    }
    public  function resendVerification(Request $request){
        $user = User::where('id',$request->user()->id)->update([
            'email_verify_token' => Str::random(60),
            'email_token_expire' => time(),
        ]);
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : $this->redirectAfterVerified();
        }
        $user = User::where('id',$request->user()->id)->first();
        $user->emailVerificationNotification();
        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
    public function emailVerifySuccess(){
        $redirect = route('frontend.index');
        return view('common.verify-email-success',compact('redirect'));
    }

    protected function redirectAfterVerified(){
        if (Auth::check()) {
            return to_route('user.dashboard');
        }
        return redirect('/');
    }
}
