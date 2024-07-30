<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'productDetail'])->name('shop.product.detail');



Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/process',[CartController::class, 'process'])->name('cart.process');
});

Route::middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/manage', [AdminController::class, 'manage'])->name('admin.manage');
    Route::get('/manage/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/manage/store', [AdminController::class, 'store'])->name('admin.store');


    Route::get('/manage/{id_product}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/manage/{id_brand}', [AdminController::class, 'deleteBrand'])->name('admin.deleteBrand');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
