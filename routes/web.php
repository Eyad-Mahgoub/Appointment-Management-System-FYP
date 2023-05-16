<?php

use Illuminate\Support\Facades\Route;

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

Route::controller(\App\Http\Controllers\FrontEnd\HomeController::class)->group(function () {
    Route::get('/', 'index')                ->name('frontend.home');
    Route::get('/doctors', 'doctors')       ->name('frontend.doctors');
    Route::get('/services', 'services')     ->name('frontend.services');
    Route::get('/about-us', 'about-us')     ->name('frontend.aboutus');

});



Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () {
    Route::get('/login', 'index')               ->name('frontend.loginpage');
    Route::post('/login', 'login')              ->name('frontend.login');
    Route::post('/register', 'register')        ->name('frontend.register');
    Route::post('/logout', 'logout')            ->name('frontend.logout');
});
