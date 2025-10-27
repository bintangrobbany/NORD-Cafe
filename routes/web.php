<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', [logincontroller::class, 'login'])->name('login');
Route::post('/postlogin', [logincontroller::class, 'postlogin'])->name('postlogin');
Route::get('/register', [logincontroller::class, 'register'])->name('register');
Route::post('/postregister', [logincontroller::class, 'postregister'])->name('postregister');
Route::get('/logout', [logincontroller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [logincontroller::class, 'index'])->name('index');
});
