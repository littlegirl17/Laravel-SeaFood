<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

    Route::get('/', [HomeController::class, 'index']);

// ROUTE USER
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register',[UserController::class, 'register']);

    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'login']);

    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/forget-password', function () {
        return view('forgetPassword');
    })->name('forgetPassword');
    Route::post('/forgetPassword', [UserController::class, 'forgetPassword'])->name('form-forget-passwword');

    //route view mã xác nhận và handle
    Route::get('/verify-code', function () {
        return view('verifyCode');
    })->name('verify-code');
    Route::post('/verify-code', [UserController::class, 'verifyCode'])->name('verify-code');

    // route view nhập lại mật khẩu và handle
    Route::get('/reset-password', function () {
        return view('resetPassword');
    })->name('reset-password');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');


// ROUTE DETAIL CATEGORY & PRODUCT
    Route::get('/category/{slug}',[CategoryController::class, 'index']);

    Route::get('/detail-product/{slug}', [ProductController::class, 'detail'] );

// ROUTE PRODUCT CART
    Route::get('/viewCart', [ProductController::class, 'viewCart']);
    Route::post('/add-to-cart', [ProductController::class, 'addToCart']);
    Route::get('/giam-quantity/{id}', [ProductController::class, 'giamQuantity'])->name('giam');
    Route::get('/tang-quantity/{id}', [ProductController::class, 'tangQuantity'])->name('tang');
    Route::get('/delete-item-cart/{id}', [ProductController::class, 'deleteItemCart'])->name('deleteItem');
    Route::get('/delete-all-cart', [ProductController::class, 'deleteAllCart'])->name('deleteAll');

    Route::post('/buy-now', [ProductController::class, 'buyNow']);
    Route::get('/clear-buy-now', [ProductController::class, 'clearBuyNowCart'])->name('clearBuyNow');


// ROUTE COMMENT
    Route::post('/add-comment', [ProductController::class, 'comment']);

// ROUTE CHECKOUT
    Route::get('/checkout', [ProductController::class, 'viewcheckout']);

    Route::post('/checkout', [ProductController::class, 'checkout']);

    Route::get('/vieworder', [ProductController::class, 'vieworder']);

    Route::post('/coupon', [ProductController::class, 'couponApply'])->name('coupon');
    Route::get('/delete-coupon', [ProductController::class, 'couponDelete'])->name('couponDelete');

//
Route::get('/search-home', [HomeController::class, 'search'])->name('home.search');
Route::get('/search-category', [AdminController::class, 'searchCategory'])->name('searchCategory');
Route::get('/search-product', [AdminController::class, 'searchProduct'])->name('searchProduct');
Route::get('/search-coupon', [AdminController::class, 'searchCoupon'])->name('searchCoupon');
Route::get('/search-order', [AdminController::class, 'searchOrder'])->name('searchOrder');
Route::get('/search-user', [AdminController::class, 'searchUser'])->name('searchUser');
Route::get('/search-comment', [AdminController::class, 'searchComment'])->name('searchComment');


// ROTE ADMIN
Route::prefix('admin')->group(function(){

    Route::get('manage', function () {
        return view('admin.login');
    });

    Route::post('manage', [AdminController::class , 'manage']);

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('category', [AdminController::class , 'category'])->name('category');
    Route::get('addcategory', [AdminController::class , 'categoryAdd'])->name('categoryAdd');
    Route::post('add-category', [AdminController::class , 'categoryAdd']);
    Route::get('edit-category/{id}', [AdminController::class , 'categoryEdit'])->name('categoryEdit');
    Route::put('edit-category/{id}', [AdminController::class , 'categoryUpdate'])->name('categoryUpdate');
    Route::get('delete-category/{id}', [AdminController::class , 'categoryDelete'])->name('categoryDelete');

    Route::get('product', [AdminController::class , 'product'])->name('product');
    Route::get('addproduct', [AdminController::class , 'productAdd'])->name('productAdd');
    Route::post('add-product', [AdminController::class , 'productAdd']);
    Route::get('edit-product/{id}', [AdminController::class , 'productEdit'])->name('productEdit');
    Route::put('edit-product/{id}', [AdminController::class , 'productUpdate'])->name('productUpdate');
    Route::get('delete-product/{id}', [AdminController::class , 'productDelete'])->name('productDelete');
    Route::get('product/{id}/delete-image/{product_id}', [AdminController::class , 'deleteImages'])->name('product.delete-images');

    Route::get('order', [AdminController::class , 'order'])->name('admin.order');
    Route::get('addorder', [AdminController::class , 'orderAdd'])->name('admin.orderAdd');
    Route::post('add-order', [AdminController::class , 'orderAdd']);
    Route::get('edit-order/{id}', [AdminController::class , 'orderEdit'])->name('admin.orderEdit');
    Route::put('edit-order/{id}', [AdminController::class , 'orderUpdate'])->name('admin.orderUpdate');
    Route::get('delete-order/{id}', [AdminController::class , 'orderDelete'])->name('admin.orderDelete');

    Route::get('coupon', [AdminController::class , 'coupon'])->name('admin.coupon');
    Route::get('addcoupon', [AdminController::class , 'couponAdd'])->name('admin.couponAdd');
    Route::post('add-coupon', [AdminController::class , 'couponAdd']);
    Route::get('edit-coupon/{id}', [AdminController::class , 'couponEdit'])->name('admin.couponEdit');
    Route::put('edit-coupon/{id}', [AdminController::class , 'couponUpdate'])->name('admin.couponUpdate');
    Route::get('delete-coupon/{id}', [AdminController::class , 'couponDelete'])->name('admin.couponDelete');

    Route::get('user', [AdminController::class , 'user'])->name('user');
    Route::get('adduser', [AdminController::class , 'userAdd'])->name('userAdd');
    Route::post('add-user', [AdminController::class , 'userAdd']);
    Route::get('edit-user/{id}', [AdminController::class , 'userEdit'])->name('userEdit');
    Route::put('edit-user/{id}', [AdminController::class , 'userUpdate'])->name('userUpdate');
    Route::get('delete-user/{id}', [AdminController::class , 'userDelete'])->name('userDelete');

    Route::get('comment', [AdminController::class , 'comment'])->name('comment');

    Route::get('logout', [AdminController::class, 'logout'])->name('logout');

});

Route::post('paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

Route::fallback(function(){
    return view('notFound');
});