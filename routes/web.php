<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ProductController as ProductController;
use App\Http\Controllers\SearchController;
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

//home routes
Route::get('/', [HomeController::class, 'index']);

//product routes
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::post('/product/comment', [ProductController::class, 'postComment'])->name('product.post-comment');

//user routes
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

    //order
    Route::get('/order', [UserController::class, 'getOrder'])->name('order.index');
    Route::post('/order', [UserController::class, 'postOrder'])->name('order.store');
});

//Admin routes
Route::prefix('admin')->middleware(['auth', 'verified', 'can:is-admin'])->name('admin.')->group(function() {
    //user routes
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    Route::resource('/users', AdminUserController::class);

    //product routes
    Route::get('/products/search', [AdminProductController::class, 'search'])->name('products.search');
    Route::resource('/products', AdminProductController::class);

    //order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});