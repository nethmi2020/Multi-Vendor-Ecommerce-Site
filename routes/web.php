<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::resource('categories', CategoryController::class)->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pusher', function () {
    return view('pusher');
});

Route::get('products/export/', [ProductController::class, 'export'])->name('products.export');
Route::get('/api_shop',[SiteController::class, 'apiIndex'])->name('api-shop');
Route::get('/api_shop/{id}',[SiteController::class, 'apiShow'])->name('api-show');
Route::get('/shop',[SiteController::class, 'index'])->name('shop');
Route::get('/add_to_cart/{product}',[SiteController::class, 'addToCart'])->name('product.add_to_cart');
Route::get('/remove_cart/{product}',[SiteController::class, 'removeCart'])->name('product.remove_cart');
Route::get('/cart',[SiteController::class, 'cart'])->name('cart');
Route::get('/change_language/{language}',[SiteController::class, 'changeLanguage'])->name('change_language');

Route::get('/dashboard', function () {
    // app()->setlocale('si');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','isAdmin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class)->withoutMiddleware('isAdmin');


});

Route::group(['middleware' => ['auth', 'role:seller|admin']], function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::controller(FacebookController::class)->group(function(){
    Route::get('login/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('login/facebook/callback', 'handleFacebookCallback');
});
