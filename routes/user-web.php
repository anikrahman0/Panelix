<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\SocialAuthController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\ResetPasswordController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\EmailVerificationController;

Route::prefix('user')->group( function () {
    Route::controller(UserLoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('user.login');
        Route::patch('/login', 'login')->name('user.login.submit');
        Route::post('/logout', 'logout')->name('user.logout');
    });
    Route::controller(UserRegisterController::class)->group(function () {
        Route::get('/register', 'showRegisterForm')->name('user.register');
        Route::post('/register', 'userRegisterSubmit')->name('user.register.submit');
    });
    Route::controller(SocialAuthController::class)->group(function () {
        Route::prefix('sign-in')->group(function () {
            Route::get('facebook', 'authFacebook')->name('user.login.facebook');
            Route::get('facebook/redirect', 'facebookRedirect');
            Route::get('google', 'authGoogle')->name('user.login.google');
            Route::get('google/redirect', 'googleRedirect');
        });
    });
    Route::middleware(['auth.user', 'email-verified', 'check-password-change']) ->controller(UserController::class)->group(function () {
        Route::post('/get/state', 'getStatesAjax')->name('user.states.ajax');
        Route::post('/get/cities', 'getCitiesAjax')->name('user.cities.ajax');
        Route::get('/dashboard', 'dashboard')->name('user.dashboard');
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'userProfileUpdate')->name('user.profile.update');
        Route::get('/orders', 'orders')->name('user.orders');
        Route::get('/order/{id}', 'orderDetails')->name('user.order.details');
        Route::get('/change-password', 'changePassword')->name('user.change.password');
        Route::post('/change/password/update', 'updateUserPassword')->name('user.password.update');
        Route::get('/wishlist', 'wishlist')->name('user.wishlist');
        Route::post('/update/wishlist', 'wishlistUpdate')->name('wishlist.update');
        Route::get('/delete/wishlist/{id}', 'wishlistDelete')->name('wishlist.delete');
        Route::post('/book/review/submit', 'reviewStoreOrUpdate')->name('user.book.review.submit');
    });

    Route::controller(EmailVerificationController::class)->group(function () {
        Route::group(['middleware' => 'auth.user'], function () {
            Route::get('/email/verify', 'show')->name('email.verify.show');
            Route::post('/verification/resend', 'resendVerification')->name('email.verify.resend');
        });
        Route::get('/verify/email/{user_id}/{token}', 'verify')->name('email.verify');
        Route::get('/email/verify/success', 'emailVerifySuccess')->name('email.verify.success');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forgot-password', 'showLinkRequestForm')->name('user.password.request');
        Route::post('forgot-password', 'sendResetLinkEmail')->name('user.password.email');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

});


