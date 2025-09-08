<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BookBundleController;
use App\Http\Controllers\Admin\BookReviewController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\AdminNotoficationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;

// Auth::routes([
//     'register' => false,
//     'verify' => false,
//     'login' => false,
//     'reset' => false
// ]);


Route::controller(AdminLoginController::class)->group(function () {
    Route::get('/poLOid_fo-oi_98d082plo_odjfgf0d-a2l-8_k-l', 'showAdminLoginForm')->name('admin.loginpage');
    Route::post('/ko_95xgfj0d-al-dyrt-98--toi_y80d511', 'adminLogin')->name('admin.login');
    Route::post('/admin/logout', 'adminLogout')->name('admin.logout');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::controller(AdminNotoficationController::class)->group(function () {
        Route::get('/admin-notifications/read/{id}', 'readNotification')->name('admin.notifications.read');
    });

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

    //slider
    Route::controller(SliderController::class)->group(function () {
        Route::prefix('sliders')->group(function () {
            Route::middleware('check-permission:sliders')->group(function () {
                Route::get('/', 'index')->name('admin.sliders.index');
                Route::get('/add', 'create')->name('admin.sliders.add');
                Route::post('/store', 'store')->name('admin.sliders.store');
                Route::get('/edit/{id}', 'edit')->name('admin.sliders.edit');
                Route::post('/update/{id}', 'update')->name('admin.sliders.update');
                Route::get('/delete/{id}', 'destroy')->name('admin.sliders.delete');
            });
        });
    });
    //books
    Route::controller(BookController::class)->group(function () {
        Route::prefix('books')->group(function () {
            Route::get('/get', 'get')->name('admin.book.get');
            Route::get('/', 'index')->name('admin.books.index')->middleware('check-permission:book');
            Route::get('/add', 'create')->name('admin.books.add')->middleware('check-permission:book-create');
            Route::post('/store', 'store')->name('admin.books.store')->middleware('check-permission:book-create');
            Route::get('/edit/{id}', 'edit')->name('admin.books.edit')->middleware('check-permission:book-update');
            Route::patch('/update/{id}', 'update')->name('admin.books.update')->middleware('check-permission:book-update');
            Route::get('/delete/{id}', 'destroy')->name('admin.books.delete')->middleware('check-permission:book-delete');
            // Route::post('/delete/gallery', 'deleteBookGallery')->name('admin.book.gallery.delete')->middleware('check-permission:book-delete');
            // Route::post('/get/related/elements', 'getRelatedElements')->name('admin.book.related.elements')->middleware('check-permission:book');
        });
    });
    //Book Bundle
    Route::controller(BookBundleController::class)->group(function () {
        Route::prefix('book-bundles')->group(function () {
            Route::middleware('check-permission:books')->group(function () {
                Route::get('/', 'index')->name('admin.book.bundles.index');
                Route::get('/add', 'create')->name('admin.book.bundles.add');
                Route::post('/store', 'store')->name('admin.book.bundles.store');
                Route::get('/edit/{id}', 'edit')->name('admin.book.bundles.edit');
                Route::post('/update/{id}', 'update')->name('admin.book.bundles.update');
                Route::get('/delete/{id}', 'destroy')->name('admin.book.bundles.delete');
            });
        });
    });
    // categories
    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('categories')->group(function () {
            Route::middleware('check-permission:category')->group(function () {
                Route::get('/get', 'getCategory')->name('admin.categories.get');
                Route::post('/sort', 'sort')->name('admin.categories.sort');
                Route::get('/', 'index')->name('admin.categories.index');
                Route::get('/add', 'create')->name('admin.categories.add');
                Route::post('/store', 'store')->name('admin.categories.store');
                Route::get('/edit/{id}', 'edit')->name('admin.categories.edit');
                Route::post('/update/{id}', 'update')->name('admin.categories.update');
                Route::get('/delete/{id}', 'destroy')->name('admin.categories.delete');
                Route::get('/sub-category', 'indexSubcategory')->name('admin.subcategories.index');
                Route::get('/sub-category/add', 'createSubcategory')->name('admin.subcategories.add');
                Route::post('subcategory/store', 'storeSubcategory')->name('admin.subcategories.store');
                Route::get('/sub-category/edit/{id}', 'editSubcategory')->name('admin.subcategories.edit');
                Route::post('subcategory/update/{id}', 'updateSubcategory')->name('admin.subcategories.update');
            });
        });
    });

    //flash sale
    Route::controller(FlashSaleController::class)->group(function () {
        Route::prefix('flash-sale')->group(function () {
            Route::middleware('check-permission:flash-sale')->group(function () {
                Route::get('/', 'index')->name('admin.flash-sale.index');
                Route::get('/add', 'create')->name('admin.flash-sale.add');
                Route::post('/store', 'store')->name('admin.flash-sale.store');
                Route::get('/edit/{id}', 'edit')->name('admin.flash-sale.edit');
                Route::post('/update/{id}', 'update')->name('admin.flash-sale.update');
                Route::get('/delete/{id}', 'destroy')->name('admin.flash-sale.delete');
            });
        });
    });

    //coupon
    Route::controller(CouponController::class)->group(function () {
        Route::prefix('coupon')->group(function () {
            Route::get('/', 'index')->name('admin.coupon.index')->middleware('check-permission:coupon');
            Route::get('/add', 'create')->name('admin.coupon.add')->middleware('check-permission:coupon-create');
            Route::post('/store', 'store')->name('admin.coupon.store')->middleware('check-permission:coupon-create');
            Route::get('/edit/{id}', 'edit')->name('admin.coupon.edit')->middleware('check-permission:coupon-update');
            Route::patch('/update/{id}', 'update')->name('admin.coupon.update')->middleware('check-permission:coupon-update');
            Route::get('/delete/{id}', 'destroy')->name('admin.coupon.delete')->middleware('check-permission:coupon-delete');
        });
    });

    //tags
    Route::controller(TagController::class)->group(function () {
        Route::prefix('tags')->group(function () {
            Route::get('/get', 'get')->name('admin.tags.get')->middleware('check-permission:book-tag');
            Route::get('/', 'index')->name('admin.tag.index')->middleware('check-permission:book-tag');
            Route::get('/add', 'create')->name('admin.tag.add')->middleware('check-permission:book-tag-create');
            Route::post('/store', 'store')->name('admin.tag.store')->middleware('check-permission:book-tag-create');
            Route::get('/edit/{id}', 'edit')->name('admin.tag.edit')->middleware('check-permission:book-tag-update');
            Route::patch('/update/{id}', 'update')->name('admin.tag.update')->middleware('check-permission:book-tag-update');
            Route::get('/delete/{id}', 'destroy')->name('admin.tag.delete')->middleware('check-permission:book-tag-delete');
        });
    });

    //Book Rating Review
    Route::controller(BookReviewController::class)->group(function () {
        Route::prefix('reviews')->group(function () {
            Route::get('/', 'index')->name('admin.review.index')->middleware('check-permission:book-rating-review');
            Route::get('/add', 'create')->name('admin.review.add')->middleware('check-permission:book-rating-review');
            Route::post('/store', 'store')->name('admin.review.store')->middleware('check-permission:book-rating-review');
            Route::get('/edit/{id}', 'edit')->name('admin.review.edit')->middleware('check-permission:book-rating-review');
            Route::patch('/update/{id}', 'update')->name('admin.review.update')->middleware('check-permission:book-rating-review');
            Route::get('/delete/{id}', 'destroy')->name('admin.review.delete')->middleware('check-permission:book-rating-review-delete');
            Route::post('/approve/{id}', 'approve')->name('admin.review.approve')->middleware('check-permission:book-rating-review');
        });
    });

    //authors
    Route::controller(AuthorController::class)->group(function () {
        Route::prefix('authors')->group(function () {
            Route::get('/get', 'get')->name('admin.author.get')->middleware('check-permission:authors');
            Route::get('/', 'index')->name('admin.author.index')->middleware('check-permission:authors');
            Route::get('/add', 'create')->name('admin.author.add')->middleware('check-permission:authors');
            Route::post('/store', 'store')->name('admin.author.store')->middleware('check-permission:authors');
            Route::get('/edit/{id}', 'edit')->name('admin.author.edit')->middleware('check-permission:authors');
            Route::patch('/update/{id}', 'update')->name('admin.author.update')->middleware('check-permission:authors');
            Route::get('/delete/{id}', 'destroy')->name('admin.author.delete')->middleware('check-permission:authors');
            Route::post('/sort', 'sort')->name('admin.author.sort')->middleware('check-permission:authors');
        });
    });

    //publishers
    Route::controller(PublisherController::class)->group(function () {
        Route::prefix('publishers')->group(function () {
            Route::get('/get', 'get')->name('admin.publisher.get')->middleware('check-permission:publishers');
            Route::get('/', 'index')->name('admin.publisher.index')->middleware('check-permission:publishers');
            Route::get('/add', 'create')->name('admin.publisher.add')->middleware('check-permission:publishers');
            Route::post('/store', 'store')->name('admin.publisher.store')->middleware('check-permission:publishers');
            Route::get('/edit/{id}', 'edit')->name('admin.publisher.edit')->middleware('check-permission:publishers');
            Route::patch('/update/{id}', 'update')->name('admin.publisher.update')->middleware('check-permission:publishers');
            Route::get('/delete/{id}', 'destroy')->name('admin.publisher.delete')->middleware('check-permission:publishers');
        });
    });

    // social icon
    Route::controller(SocialIconController::class)->group(function () {
        Route::prefix('social-icon')->group(function () {
            Route::get('/', 'index')->name('admin.social-icon.index')->middleware('check-permission:social-platform');
            Route::get('/add', 'create')->name('admin.social-icon.add')->middleware('check-permission:social-platform-create');
            Route::post('/store', 'store')->name('admin.social-icon.store')->middleware('check-permission:social-platform-create');
            Route::get('/edit/{id}', 'edit')->name('admin.social-icon.edit')->middleware('check-permission:social-platform-update');
            Route::patch('/update/{id}', 'update')->name('admin.social-icon.update')->middleware('check-permission:social-platform-update');
            Route::get('/delete/{id}', 'destroy')->name('admin.social-icon.delete')->middleware('check-permission:social-platform-delete');
        });
    });

    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'orders')->name('admin.orders.index')->middleware('check-permission:order');
        Route::get('/order/{order_id}', 'orderDetails')->name('admin.order.details')->middleware('check-permission:view-orders');
        Route::get('/order/{status}/{id}', 'changeOrderStatus')->name('admin.order.change.status')->middleware('check-permission:order');
        Route::get('/order/payment/{status}/{id}', 'changeOrderPaymentStatus')->name('admin.order.payment.change.status')->middleware('check-permission:order');
    });

    // Payments
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payments', 'payments')->name('admin.payments.index')->middleware('check-permission:payment');
        Route::get('/payment/{status}/{id}', 'changePaymentStatus')->name('admin.payment.change.status')->middleware('check-permission:payment');
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