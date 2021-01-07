<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.common.home');
});

Route::get('/product/1', function () {
    return view('pages.common.product');
});

Route::get('/search', function () {
    return view('pages.common.search');
});

Route::prefix('user')->middleware(['auth', 'verified', 'can:is-customer'])->name('user.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');

    //favourite
    Route::get('/favourites', [UserController::class, 'getFavourites'])->name('favourites.index');
    Route::post('/favourites', [UserController::class, 'addFavourite'])->name('favourites.store');
    Route::delete('/favourites', [UserController::class, 'removeFavourite'])->name('favourites.destroy');

    //cart
    Route::get('/cart', [UserController::class, 'getCart'])->name('cart.index');
    Route::post('/cart', [UserController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart', [UserController::class, 'removeFromCart'])->name('cart.remove');

    //profile
    Route::get('/profile', [UserController::class, 'getProfile'])->name('profile.index');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

//Admin routes
Route::prefix('admin')->middleware(['auth', 'verified', 'can:is-admin'])->name('admin.')->group(function() {
    //user routes
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    Route::resource('/users', AdminUserController::class);

    //product routes
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('/products', ProductController::class);

    //order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});