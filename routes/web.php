<?php

//fornt end

// ----------------- Frontend Routes -----------------
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserCheckOutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserOrderController;

// Route dành cho người dùng
Route::prefix('login')->group(function () {
    Route::get('/show', [UserController::class, 'index'])->name('login'); // Trang đăng nhập
    Route::post('/signin', [UserController::class, 'loginUser'])->name('loginUser'); // Xử lý đăng nhập
    Route::get('/signup', [UserController::class, 'signUpForm'])->name('signupForm'); // Trang đăng ký (GET)
    Route::post('/signup', [UserController::class, 'signUpUser'])->name('signUpUser'); // Xử lý đăng ký (POST)
    Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout'); // Đăng xuất
});


// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Category Routes
Route::get('/category/{slug}/{id}', [UserCategoryController::class, 'index'])->name('category.product');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/add/{id}', [UserProductController::class, 'addToCart'])->name('addToCart');
    Route::get('/show', [UserProductController::class, 'showCart'])->name('showCart');
    Route::get('/update', [UserProductController::class, 'updateCart'])->name('updateCart');
    Route::get('/delete/{id}', [UserProductController::class, 'deleteCart'])->name('deleteCart');
});

//chekout
Route::prefix('checkout')->group(function () {
    Route::get('/show', [UserCheckOutController::class, 'checkOut'])->name('checkOut');
    Route::post('/process', [UserCheckOutController::class, 'processPayment'])->name('processPayment');
});


// Route order
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [UserOrderController::class, 'index'])->name('user.orders');
    Route::get('/{id}', [UserOrderController::class, 'show'])->name('user.orders.show');
    Route::post('/{id}/received', [UserOrderController::class, 'markAsReceived'])->name('user.orders.received');
    Route::post('/{id}/cancel', [UserOrderController::class, 'cancelOrder'])->name('user.orders.cancel');
});


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminProductController; 
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminHomeController;

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'loginAdmin')->name('admin.login');
    Route::post('/admin', 'postLoginAdmin')->name('admin.postLogin');
    Route::post('/admin/logout', 'logoutAdmin')->name('admin.logout');
});

// Route cho trang lỗi 403
Route::get('/403', function () {
    return view('errors.403_user');
})->name('403');

Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('categories.index')->middleware('can:category-list');
        Route::get('/create', 'create')->name('categories.create')->middleware('can:category-add');
        Route::post('/store', 'store')->name('categories.store');
        Route::get('/edit/{id}', 'edit')->name('categories.edit')->middleware('can:category-edit');
        Route::post('/update/{id}', 'update')->name('categories.update');
        Route::get('/delete/{id}', 'delete')->name('categories.delete')->middleware('can:category-delete');
    });

    Route::prefix('menus')->controller(MenuController::class)->group(function () {
        Route::get('/', 'index')->name('menus.index')->middleware('can:menu-list');
        Route::get('/create', 'create')->name('menus.create')->middleware('can:menu-add');
        Route::post('/store', 'store')->name('menus.store');
        Route::get('/edit/{id}', 'edit')->name('menus.edit')->middleware('can:menu-edit');
        Route::post('/update/{id}', 'update')->name('menus.update');
        Route::get('/delete/{id}', 'delete')->name('menus.delete')->middleware('can:menu-delete');
    });

    Route::prefix('product')->controller(AdminProductController::class)->group(function () {
        Route::get('/', 'index')->name('product.index')->middleware('can:product-list');
        Route::get('/create', 'create')->name('product.create')->middleware('can:product-add');
        Route::post('/store', 'store')->name('product.store');
        Route::get('/edit/{id}', 'edit')->name('product.edit')->middleware('can:product-edit,id');
        Route::post('/update/{id}', 'update')->name('product.update');
        Route::get('/delete/{id}', 'delete')->name('product.delete')->middleware('can:product-delete');
    });

    Route::prefix('slider')->controller(SliderAdminController::class)->group(function () {
        Route::get('/', 'index')->name('slider.index')->middleware('can:slider-list');
        Route::get('/create', 'create')->name('slider.create')->middleware('can:slider-add');
        Route::post('/store', 'store')->name('slider.store');
        Route::get('/edit/{id}', 'edit')->name('slider.edit')->middleware('can:slider-edit');
        Route::post('/update/{id}', 'update')->name('slider.update');
        Route::get('/delete/{id}', 'delete')->name('slider.delete')->middleware('can:slider-delete');
    });

    Route::prefix('settings')->controller(AdminSettingController::class)->group(function () {
        Route::get('/', 'index')->name('settings.index')->middleware('can:setting-list');
        Route::get('/create', 'create')->name('settings.create')->middleware('can:setting-add');
        Route::post('/store', 'store')->name('settings.store');
        Route::get('/edit/{id}', 'edit')->name('settings.edit')->middleware('can:setting-edit');
        Route::post('/update/{id}', 'update')->name('settings.update');
        Route::get('/delete/{id}', 'delete')->name('settings.delete')->middleware('can:setting-delete');
    });



    Route::prefix('users')->controller(AdminUserController::class)->group(function () {
        Route::get('/', 'index')->name('users.index')->middleware('can:user-list');
        Route::get('/create', 'create')->name('users.create')->middleware('can:user-add');
        Route::post('/store', 'store')->name('users.store');
        Route::get('/edit/{id}', 'edit')->name('users.edit')->middleware('can:user-edit');
        Route::post('/update/{id}', 'update')->name('users.update');
        Route::get('/delete/{id}', 'delete')->name('users.delete')->middleware('can:user-delete');
    });

    Route::prefix('roles')->controller(AdminRoleController::class)->group(function () {
        Route::get('/', 'index')->name('roles.index')->middleware('can:role-list');
        Route::get('/create', 'create')->name('roles.create')->middleware('can:role-add');
        Route::post('/store', 'store')->name('roles.store');
        Route::get('/edit/{id}', 'edit')->name('roles.edit')->middleware('can:role-edit');
        Route::post('/update/{id}', 'update')->name('roles.update');
        Route::get('/delete/{id}', 'delete')->name('roles.delete')->middleware('can:role-delete');
    }); 

    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/{order}', 'show')->name('orders.show');
        Route::post('/{order}/approve', 'approve')->name('orders.approve');
        Route::post('/{order}/cancel', 'cancel')->name('orders.cancel');
        Route::delete('/{order}', 'destroy')->name('orders.destroy');
    });

    Route::prefix('permissions')->controller(AdminPermissionController::class)->group(function () {
        Route::get('/create', 'createPermissions')->name('permissions.create');
        Route::post('/store', 'store')->name('permissions.store');
    });
});
