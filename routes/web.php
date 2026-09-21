<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PerfumeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', DashboardController::class)->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/collection', [StorefrontController::class, 'collection'])->name('collection');
    Route::get('/about', [StorefrontController::class, 'about'])->name('about');
    Route::get('/cart', [StorefrontController::class, 'cart'])->name('cart');
    Route::post('/cart/{perfume}', [StorefrontController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart', [StorefrontController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{perfume}', [StorefrontController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [StorefrontController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/orders/{order}/payment', [StorefrontController::class, 'payment'])->name('order.payment');
    Route::post('/orders/{order}/payment-confirmation', [StorefrontController::class, 'confirmPayment'])->name('order.payment.confirm');
    Route::get('/orders/{order}/thank-you', [StorefrontController::class, 'thankYou'])->name('order.thank-you');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::get('/members', [UserController::class, 'index'])->name('users.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('perfumes', PerfumeController::class)->except('show');
});

Route::middleware('auth')->get('/dashboard', function () {
    return auth()->user()->isStaff()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->name('dashboard');
