<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomePageController;

Route::controller(HomePageController::class)->group( function () {
    Route::get('/', 'index')->name('frontend.index');
});

