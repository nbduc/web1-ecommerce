<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/profile', function () {
    return view('pages.common.profile');
})->middleware('auth');

//Admin routes
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function() {
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');;
    Route::resource('/users', UserController::class);
});