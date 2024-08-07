<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', [HomeController::class, 'index']);

// ROUTE USER
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [UserController::class, 'register']);

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
Route::get('/category/{slug}', [CategoryController::class, 'index']);

Route::get('/detail-product/{slug}', [ProductController::class, 'detail']);

// ROUTE PRODUCT CART
Route::post('/add-to-cart', [ProductController::class, 'addToCartPopup']);
Route::get('/giam-quantity/{id}', [CartController::class, 'giamQuantity'])->name('giam');
Route::get('/tang-quantity/{id}', [CartController::class, 'tangQuantity'])->name('tang');
Route::get('/delete-item-cart/{id}', [CartController::class, 'deleteItemCart'])->name('deleteItem');
Route::get('/delete-all-cart', [CartController::class, 'deleteAllCart'])->name('deleteAll');

Route::post('/buy-now', [ProductController::class, 'buyNow']);
Route::get('/clear-buy-now', [ProductController::class, 'clearBuyNowCart'])->name('clearBuyNow');


// ROUTE COMMENT
// Route::post('/add-comment', [ProductController::class, 'comment']);

// ROUTE CHECKOUT
Route::get('/checkout', [ProductController::class, 'viewcheckout']);

Route::post('/checkout', [ProductController::class, 'checkout']);

Route::get('/vieworder', [ProductController::class, 'vieworder']);

Route::post('/coupon', [ProductController::class, 'couponApply'])->name('coupon');
Route::get('/delete-coupon', [ProductController::class, 'couponDelete'])->name('couponDelete');

//
Route::get('/search-home', [HomeController::class, 'search'])->name('home.search');
Route::get('/search-banner', [AdminController::class, 'searchBanner'])->name('searchBanner');
Route::get('/search-category', [AdminController::class, 'searchCategory'])->name('searchCategory');
Route::get('/search-product', [AdminController::class, 'searchProduct'])->name('searchProduct');
Route::get('/search-coupon', [AdminController::class, 'searchCoupon'])->name('searchCoupon');
Route::get('/search-order', [AdminController::class, 'searchOrder'])->name('searchOrder');
Route::get('/search-user', [AdminController::class, 'searchUser'])->name('searchUser');
Route::get('/search-comment', [AdminController::class, 'searchComment'])->name('searchComment');
Route::get('/search-administration', [AdminController::class, 'searchAdministration'])->name('searchAdministration');

// ROTE ADMIN
Route::get('admin/manage', function () {
    return view('admin.login');
});

Route::post('manage', [AdminController::class, 'manage'])->name('admin.loginManage');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin:category'])->group(function () {
        Route::get('category', [AdminController::class, 'category'])->name('category');
        Route::get('addcategory', [AdminController::class, 'categoryAdd'])->name('categoryAdd');
        Route::post('add-category', [AdminController::class, 'categoryAdd']);
        Route::get('edit-category/{id}', [AdminController::class, 'categoryEdit'])->name('categoryEdit');
        Route::put('edit-category/{id}', [AdminController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::post('delete-checkbox-category', [AdminController::class, 'categoryDeleteCheckkbox'])->name('category.checkboxDelete');
        Route::put('update-status-category/{id}', [AdminController::class, 'categoryUpdateStatus'])->name('categoryUpdateStatus');
    });

    Route::middleware(['admin:product'])->group(function () {
        Route::get('product', [AdminController::class, 'product'])->name('product');
        Route::get('addproduct', [AdminController::class, 'productAdd'])->name('productAdd');
        Route::post('add-product', [AdminController::class, 'productAdd']);
        Route::get('edit-product/{id}', [AdminController::class, 'productEdit'])->name('productEdit');
        Route::put('edit-product/{id}', [AdminController::class, 'productUpdate'])->name('productUpdate');
        Route::post('delete-checkbox-product', [AdminController::class, 'productDeleteCheckkbox'])->name('product.checkboxDelete');
        Route::post('copy-checkbox-product', [AdminController::class, 'productCopyCheckkbox'])->name('product.checkboxCopy');
        Route::get('delete-images-product/{product_id}', [AdminController::class, 'deleteProductImages'])->name('product.delete-images');
        Route::put('update-status-product/{id}', [AdminController::class, 'productUpdateStatus'])->name('productUpdateStatus');
    });

    Route::middleware(['admin:order'])->group(function () {
        Route::get('order', [AdminController::class, 'order'])->name('admin.order');
        Route::get('addorder', [AdminController::class, 'orderAdd'])->name('admin.orderAdd');
        Route::post('add-order', [AdminController::class, 'orderAdd']);
        Route::get('edit-order/{id}', [AdminController::class, 'orderEdit'])->name('admin.orderEdit');
        Route::put('edit-order/{id}', [AdminController::class, 'orderUpdate'])->name('admin.orderUpdate');
        Route::get('delete-order/{id}', [AdminController::class, 'orderDelete'])->name('admin.orderDelete');
    });

    Route::middleware(['admin:coupon'])->group(function () {
        Route::get('coupon', [AdminController::class, 'coupon'])->name('admin.coupon');
        Route::get('addcoupon', [AdminController::class, 'couponAdd'])->name('admin.couponAdd');
        Route::post('add-coupon', [AdminController::class, 'couponAdd']);
        Route::get('edit-coupon/{id}', [AdminController::class, 'couponEdit'])->name('admin.couponEdit');
        Route::put('edit-coupon/{id}', [AdminController::class, 'couponUpdate'])->name('admin.couponUpdate');
        Route::post('delete-checkbox-coupon', [AdminController::class, 'couponDeleteCheckkbox'])->name('admin.checkboxDeleteCoupon');
        Route::put('update-status-coupon/{id}', [AdminController::class, 'couponUpdateStatus'])->name('couponUpdateStatus');
    });

    Route::middleware(['admin:banner'])->group(function () {
        Route::get('banner', [AdminController::class, 'banner'])->name('admin.banner');
        Route::get('addbanner', [AdminController::class, 'bannerAdd'])->name('admin.bannerAdd');
        Route::post('add-banner', [AdminController::class, 'bannerAdd']);
        Route::get('edit-banner/{id}', [AdminController::class, 'bannerEdit'])->name('admin.bannerEdit');
        Route::put('edit-banner/{id}', [AdminController::class, 'bannerUpdate'])->name('admin.bannerUpdate');
        Route::post('delete-checkbox-banner', [AdminController::class, 'bannerDeleteCheckkbox'])->name('admin.checkboxDeleteBanner');
        Route::get('delete-banner-images/{id}', [AdminController::class, 'deleteBannerImages'])->name('banner.delete-images');
        Route::put('update-status-banner/{id}', [AdminController::class, 'bannerUpdateStatus'])->name('bannerUpdateStatus');
    });

    Route::middleware(['admin:user'])->group(function () {
        Route::get('user', [AdminController::class, 'user'])->name('user');
        Route::get('adduser', [AdminController::class, 'userAdd'])->name('userAdd');
        Route::post('add-user', [AdminController::class, 'userAdd']);
        Route::get('edit-user/{id}', [AdminController::class, 'userEdit'])->name('userEdit');
        Route::put('edit-user/{id}', [AdminController::class, 'userUpdate'])->name('userUpdate');
        Route::post('delete-checkbox-user', [AdminController::class, 'userDeleteCheckkbox'])->name('admin.checkboxDeleteUser');
        Route::put('update-status-user/{id}', [AdminController::class, 'userUpdateStatus'])->name('userUpdateStatus');
    });

    Route::middleware(['admin:userGroup'])->group(function () {
        Route::get('userGroup', [AdminController::class, 'userGroup'])->name('admin.userGroup');
        Route::get('adduserGroup', [AdminController::class, 'userGroupAdd'])->name('admin.userGroupAdd');
        Route::post('add-userGroup', [AdminController::class, 'userGroupAdd']);
        Route::get('edit-userGroup/{id}', [AdminController::class, 'userGroupEdit'])->name('admin.userGroupEdit');
        Route::put('edit-userGroup/{id}', [AdminController::class, 'userGroupUpdate'])->name('admin.userGroupUpdate');
        Route::post('delete-checkbox-userGroup', [AdminController::class, 'userGroupDeleteCheckkbox'])->name('checkboxDeleteUserGroup');
    });

    Route::middleware(['admin:administration'])->group(function () {
        Route::get('administration', [AdminController::class, 'administration'])->name('administration');
        Route::get('addadministration', [AdminController::class, 'administrationAdd'])->name('administrationAdd');
        Route::post('add-administration', [AdminController::class, 'administrationAdd']);
        Route::get('edit-administration/{id}', [AdminController::class, 'administrationEdit'])->name('administrationEdit');
        Route::put('edit-administration/{id}', [AdminController::class, 'administrationUpdate'])->name('administrationUpdate');
        Route::post('delete-checkbox-administration', [AdminController::class, 'administrationDeleteCheckkbox'])->name('checkboxDeleteAdministration');
    });

    Route::middleware(['admin:administrationGroup'])->group(function () {
        Route::get('administrationGroup', [AdminController::class, 'administrationGroup'])->name('administrationGroup');
        Route::get('addadministrationGroup', [AdminController::class, 'administrationGroupAdd'])->name('administrationGroupAdd');
        Route::post('add-administrationGroup', [AdminController::class, 'administrationGroupAdd']);
        Route::get('edit-administrationGroup/{id}', [AdminController::class, 'administrationGroupEdit'])->name('administrationGroupEdit');
        Route::put('edit-administrationGroup/{id}', [AdminController::class, 'administrationGroupUpdate'])->name('administrationGroupUpdate');
        Route::post('delete-checkbox-administrationGroup', [AdminController::class, 'administrationGroupDeleteCheckkbox'])->name('checkboxDeleteAdministrationGroup');
    });

    Route::middleware(['admin:comment'])->group(function () {
        Route::get('comment', [AdminController::class, 'comment'])->name('admin.comment');
        Route::put('update-status-comment/{id}', [AdminController::class, 'commentUpdateStatus'])->name('commentUpdateStatus');
        Route::post('delete-checkbox-comment', [AdminController::class, 'commentDeleteCheckkbox'])->name('comment.checkboxDelete');
        Route::get('delete-comment/{id}', [AdminController::class, 'commentDelete'])->name('admin.commentDelete');
    });

    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
});

//
Route::get('cart', [CartController::class, 'getCart']);

// api
Route::prefix('api')->group(function () {
    Route::get('comment/product/{product_id}', [CommentController::class, 'comment']);
    Route::post('comment', [CommentController::class, 'store']);

    // cart
    Route::post('addToCart/product', [CartController::class, 'store']);
});

// my account
Route::get('user/account/profile', function () {
    return view('account.profile');
})->name('account.profile');

Route::get('user/account/address', function () {
    return view('account.address');
})->name('account.address');

Route::get('user/account/password', function () {
    return view('account.password');
})->name('account.password');

Route::get('user/account/purchase', [AccountController::class, 'purchase'])->name('account.purchase');

Route::fallback(function () {
    return view('notFound');
});
