<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

// =========================================================================
// RUTE UNTUK USER BIASA
// =========================================================================
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/postregister', [LoginController::class, 'postregister'])->name('postregister');
});

Route::middleware('auth')->group(function () {
    Route::get('/index', [LoginController::class, 'index'])->name('index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('checkout.page');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/pesanan-saya', [OrderController::class, 'myOrders'])->name('orders.history');
    Route::post('/pesanan-diterima/{order}', [OrderController::class, 'markAsCompleted'])->name('orders.complete');
    Route::get('/pesanan-berhasil', function () {
        return session('success') ? view('checkout-success') : redirect()->route('index');
    })->name('checkout.success');
});

// =========================================================================
// RUTE UNTUK ADMIN (SISTEM BARU YANG SUDAH DIPERBAIKI)
// =========================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Grup untuk tamu admin (yang BELUM login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    });

    // Grup untuk admin yang SUDAH login
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Rute Produk
        Route::get('/products', [AdminController::class, 'productsIndex'])->name('products.index');
        Route::get('/products/create', [AdminController::class, 'productsCreate'])->name('products.create');
        Route::post('/products', [AdminController::class, 'productsStore'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminController::class, 'productsEdit'])->name('products.edit');
        Route::put('/products/{product}', [AdminController::class, 'productsUpdate'])->name('products.update');
        Route::delete('/products/{product}', [AdminController::class, 'productsDestroy'])->name('products.destroy');

        // Rute Pesanan (Admin)
        Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('orders.index');
        Route::get('/orders/{order}', [AdminController::class, 'reviewOrder'])->name('orders.review');
        Route::post('/orders/{order}/confirm', [AdminController::class, 'confirmOrder'])->name('orders.confirm');
        Route::post('/orders/{order}/cancel', [AdminController::class, 'cancelOrder'])->name('orders.cancel');
    });
});