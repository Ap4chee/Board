<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect('/en');
});

Route::prefix('en')->middleware('web')->group(function () {
    
    
    Route::get('/', function () {
        return Auth::check() ? redirect('/en/dashboard') : redirect('/en/login');
        
    });

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('en.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('en.register');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('en.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('en.login');

    Route::post('/logout', [AuthController::class, 'logout'])->name('en.logout');

    Route::get('/dashboard', [AdController::class, 'index'])->middleware('auth')->name('en.dashboard');

    Route::get('/add', function () {
        return view('en.add');
    })->middleware('auth')->name('en.add');

    Route::post('/ads', [AdController::class, 'store'])->middleware('auth')->name('en.ads.store');
});
Route::delete('/ads/{id}', [AdController::class, 'destroy'])->middleware('auth')->name('en.ads.destroy');


Route::get('/admin', [AdminController::class, 'ads'])->name('admin.ads');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->middleware('auth')->name('contact');

Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'send'])->middleware('auth')->name('contact.send');
