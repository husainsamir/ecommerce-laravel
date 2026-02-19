<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductImageController;

// Here User Controller Define
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;

use App\Http\Controllers\User\CheckoutController;
// Admin Order Routes
use App\Http\Controllers\Admin\OrdersController;
 // Here Start Payment Controller  
use App\Http\Controllers\User\OrderPaymentController;

use App\Http\Controllers\User\OrderController;
// ==============================
// AUTH ROUTES
 // ajax login route
use App\Http\Controllers\Auth\AjaxLoginController;

// ==============================

// Register Page
Route::get('/', [AuthController::class, 'showRegister'])->name('admin.register');
Route::post('/', [AuthController::class, 'register'])->name('admin.register.submit');

// Login Page
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Logout
Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');

// Redirect after login based on role
Route::get('/redirect-after-login', [AuthController::class, 'redirectAfterLogin'])->middleware('auth')->name('redirect.after.login');



// ==============================
// ADMIN ROUTES
// ==============================

  // Dashboard
Route::get('/admin/dashboard',[AuthController::class,'showDash'])
    ->middleware('auth')
    ->name('admin.dashboard');

    
// admin ctaegory routes here--

Route::middleware(['auth'])->group(function() {

    // List all categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('category.index');

    // Show create category form
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('category.create');

    // Store new category
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('category.store');

    // Show edit form
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

    // Update category (MISSING before)
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('category.update');

    // Delete category
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

// admin products routes her-- 



Route::middleware(['auth'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])
        ->name('product.index');

    //   static route hamesha upar
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('product.addproduct');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('product.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('product.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('product.destroy');
});

  Route::middleware(['auth'])->group(function(){

    Route::get('/admin/productsVariants',[ProductVariantController::class,'index'])->name('productVariant.index');
    Route::get('/admin/productsVariants/create',[ProductVariantController::class,'create'])->name('productVariant.addproductVariants');
    Route::post('/admin/products',[ProductVariantController::class,'store'])->name('productVariant.store');
    Route::get('/admin/products/{id}/edit',[ProductVariantController::class,'edit'])->name('productVariant.edit');
    Route::delete('/admin/products/{id}',[ProductVariantController::class,'destroy'])->name('product.destroy');

});


   // admin coupon routing

    Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});


   // admin orders routes 

    Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('admin.orders.show');
     Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');
});


 // From Here start user routes  
// Home page
Route::get('/home', [HomeController::class, 'index'])->name('user.home');
     // user Login Page
Route::get('/login', [AuthController::class, 'showUserLogin'])
    ->name('user.login');

Route::post('/login', [AuthController::class, 'userLogin'])
    ->name('user.login.submit');

// ajax login 

Route::post('/ajax-login', [AjaxLoginController::class, 'login'])
    ->name('ajax.login');



// All Produpcts 
Route::get('/product', [UserProductController::class, 'index'])
    ->name('user.products.index');

// Single Product (id-based)
Route::get('/product/{id}', [UserProductController::class, 'show'])
    ->name('user.products.show');

// Category Products (id-based)
Route::get('/category/{id}', [UserProductController::class, 'categoryProducts'])
    ->name('user.category.products');

// 
// CART ROUTES
// 

Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');
 // cart increase dcrease button 


Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');

// ==============================
// CHECKOUT & ORDER
// ==============================

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class,'index'])
        ->name('checkout.index');

    Route::post('/place-order', [CheckoutController::class,'placeOrder'])
        ->name('checkout.place');

   Route::middleware('auth')->get('/order-success', [CheckoutController::class, 'success'])
    ->name('orders.success');

});    

  

 // this routing for payment 
Route::middleware(['auth'])->group(function () {

    Route::get('/payment/{order}',
        [OrderPaymentController::class, 'showPaymentPage']
    )->name('payment.page');

    // Stripe Checkout (NO JS)
    Route::post('/payment/stripe/checkout',
        [OrderPaymentController::class, 'stripeCheckout']
    )->name('payment.stripe.checkout');

    Route::get('/order/success/{order}',
        [OrderController::class, 'success']
    )->name('user.order.success');
});



   

// Add Product Page (GET)


// Store Product (POST)

