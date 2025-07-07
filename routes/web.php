<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;

$localeMiddleware = [
    \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
    \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
    'web',
];

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => $localeMiddleware,
], function() {
    Route::get('/', fn() => auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login')
    );

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [AdController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');

    Route::get('/add', fn() => view('add'))
        ->middleware('auth')
        ->name('add');
    Route::post('/ads', [AdController::class, 'store'])
        ->middleware('auth')
        ->name('ads.store');
    Route::delete('/ads/{id}', [AdController::class, 'destroy'])
        ->middleware('auth')
        ->name('ads.destroy');

    Route::get('/contact', [ContactController::class, 'show'])
        ->middleware('auth')
        ->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])
        ->middleware('auth')
        ->name('contact.send');
});

//koniec wersji jezykowych

Route::get('/admin', function (\Illuminate\Http\Request $request) {
    if (! $request->session()->get('is_admin', false)) {
        return redirect(LaravelLocalization::getLocalizedURL(null, '/login'));
    }
    $ads = \App\Models\Ad::with('user')->latest()->get();
    return view('admin', compact('ads'));
})->name('admin.ads');

Route::delete('/admin/ads/{id}', function (\Illuminate\Http\Request $request, $id) {
    if (! $request->session()->get('is_admin', false)) {
        return redirect(LaravelLocalization::getLocalizedURL(null, '/login'));
    }
    \App\Models\Ad::findOrFail($id)->delete();
    return redirect()->route('admin.ads')->with('success', 'Ad deleted.');
})->name('admin.ads.destroy');

Route::get('/lang/{locale}', function($locale) {            // nie umiem normalnie, cos nie dzialalo

    Session::put('app_locale', $locale);
    $previous = url()->previous();  
    $path = parse_url($previous, PHP_URL_PATH) ?: '/';
    $newPath = preg_replace('#^/(en|pl)(/.*|$)#', "/{$locale}$2", $path);
    return redirect()->to(url($newPath));
})
->middleware('web')
->name('lang.switch');