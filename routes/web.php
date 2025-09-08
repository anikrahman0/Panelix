<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

require __DIR__.'/admin-web.php';
require __DIR__.'/front-web.php';
require __DIR__.'/user-web.php';

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return back()->with('success', "Cache cleared successfully");
})->name('clear-cache');

