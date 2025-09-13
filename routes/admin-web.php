<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\AdminNotoficationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;


Route::controller(AdminLoginController::class)->group(function () {
    Route::get('/plo_odjf-pd_fo-o2l-8_k-li_005d5af-gf0d-a', 'showAdminLoginForm')->name('admin.loginpage');
    Route::post('/ko_95xgfj0d-al-dyrt-98--toi_y80d511', 'adminLogin')->name('admin.login');
    Route::post('/admin/logout', 'adminLogout')->name('admin.logout');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('upload-image', [ToolController::class, 'upload'])->name('ckeditor.upload');

    // permissions
    Route::controller(PermissionController::class)->group(function () {
        Route::prefix('permissions')->group(function () {
            Route::get('/', 'index')->name('admin.permissions.index');
            Route::get('/add', 'create')->name('admin.permissions.add');
            Route::post('/store', 'store')->name('admin.permissions.store');
            Route::get('/edit/{id}', 'edit')->name('admin.permissions.edit');
            Route::post('/update/{id}', 'update')->name('admin.permissions.update');
            Route::get('/delete/{id}', 'destroy')->name('admin.permissions.delete');
        });
    });

    Route::prefix('users')->group(function () {
        // users 
        Route::controller(UserController::class)->group(function () {
            Route::middleware('check-permission:users')->group(function () {
                Route::get('/get-customer', 'getCustomer')->name('admin.users.get-customer');
                Route::get('/admin-users', 'adminUsers')->name('admin.users.index-admin');
                Route::get('/customers', 'users')->name('admin.users.index-user');
            });
            Route::post('/store', 'storeUser')->name('admin.users.store')->middleware('check-permission:users-create');
            Route::get('/add', 'addUser')->name('admin.users.add')->middleware('check-permission:users-create');
            Route::middleware('check-permission:users-update')->group(function () {
                Route::get('/admin-users/edit-admin/{id}', 'editAdminUser')->name('admin.users.edit-admin');
                Route::patch('/update-admin/{id}', 'updateAdminUser')->name('admin.users.update-admin');
                Route::get('/customers/edit-user/{id}', 'editUser')->name('admin.users.edit-user');
                Route::patch('/update-user/{id}', 'updateUser')->name('admin.users.update-user');
                Route::get('/admin-users/change-password/{id}', 'changeAdminPassword')->name('admin.users.admin.change-password');
                Route::patch('/update-admin/change-password/{id}', 'updateAdminPassword')->name('admin.users.admin.update-password');
                Route::get('customers/change-password/{id}', 'changeCustomerPassword')->name('admin.users.customer.change-password');
                Route::patch('/update-user/change-password/{id}', 'updateCustomerPassword')->name('admin.users.customer.update-password');
                Route::get('/admin-users/edit-admin-profile', 'editAdminProfile')->name('admin.users.edit.admin-profile');
                Route::patch('/update-admin-profile', 'updateAdminProfile')->name('admin.users.update-admin-profile');
            });
            Route::middleware('check-permission:users-delete')->group(function () {
                Route::get('/delete-admin/{id}', 'deleteAdminUser')->name('admin.users.delete-admin');
                Route::get('/delete-user/{id}', 'deleteUser')->name('admin.users.delete-user');
            });
        });
        // roles
        Route::controller(RoleController::class)->group(function () {
            Route::prefix('roles')->group(function () {
                Route::get('/', 'index')->name('admin.roles.index')->middleware('check-permission:roles');
                Route::get('/add', 'create')->name('admin.roles.add')->middleware('check-permission:roles-create');
                Route::post('/store', 'store')->name('admin.roles.store')->middleware('check-permission:roles-create');
                Route::get('/edit/{id}', 'edit')->name('admin.roles.edit')->middleware('check-permission:roles-update');
                Route::patch('/update/{id}', 'update')->name('admin.roles.update')->middleware('check-permission:roles-update');
                Route::get('/delete/{id}', 'destroy')->name('admin.roles.delete')->middleware('check-permission:roles-delete');
            });
        });
    });

    // location
    Route::controller(LocationController::class)->group(function () {
        Route::prefix('location')->group(function () {
            //country
            Route::prefix('countries')->middleware('check-permission:country')->group(function () {
                Route::get('/', 'countries')->name('admin.countries.index');
                Route::get('/add', 'addCountry')->name('admin.countries.add');
                Route::post('/store', 'storeCountry')->name('admin.countries.store');
                Route::get('/edit/{id}', 'editCountry')->name('admin.countries.edit');
                Route::post('/update/{id}', 'updateCountry')->name('admin.countries.update');
                Route::get('/delete/{id}', 'deleteCountry')->name('admin.countries.delete');
            });
            //state
            Route::prefix('states')->middleware('check-permission:state')->group(function () {
                Route::get('/', 'states')->name('admin.states.index');
                Route::get('/add', 'addState')->name('admin.states.add');
                Route::post('/store', 'storeState')->name('admin.states.store');
                Route::get('/edit/{id}', 'editState')->name('admin.states.edit');
                Route::post('/update/{id}', 'updateState')->name('admin.states.update');
                Route::get('/delete/{id}', 'deleteState')->name('admin.states.delete');
            });
            //city
            Route::prefix('cities')->middleware('check-permission:city')->group(function () {
                Route::get('/', 'cities')->name('admin.cities.index');
                Route::post('/getStates', 'getStatesAjax')->name('admin.cities.states');
                Route::post('/getCities', 'getCitiesAjax')->name('admin.cities.ajax');
                Route::get('/add', 'addCity')->name('admin.cities.add');
                Route::post('/store', 'storeCity')->name('admin.cities.store');
                Route::get('/edit/{id}', 'editCity')->name('admin.cities.edit');
                Route::post('/update/{id}', 'updateCity')->name('admin.cities.update');
                Route::get('/delete/{id}', 'deleteCity')->name('admin.cities.delete');
            });
        });
    });
    
    //settings
    Route::controller(GeneralSettingController::class)->group(function () {
        Route::prefix('general-setting')->group(function () {
            Route::middleware('check-permission:general-setting')->group(function () {
                Route::get('/edit', 'edit')->name('admin.general-setting.edit');
                Route::post('/update', 'update')->name('admin.general-setting.update');
            });
        });
    });
});