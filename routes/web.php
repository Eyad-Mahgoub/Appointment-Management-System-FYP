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
    Route::get('/about-us', 'aboutus')      ->name('frontend.aboutus');

});



Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () {
    Route::get('/login', 'index')               ->name('frontend.loginpage');
    Route::post('/login', 'login')              ->name('frontend.login');
    Route::post('/register', 'register')        ->name('frontend.register');
    Route::post('/logout', 'logout')            ->name('frontend.logout');
});

Route::middleware(['auth', 'isPatient'])->controller(\App\Http\Controllers\Booking\AppointmentController::class)->group(function () {
    Route::get('/book', 'index')                        ->name('booking.index');
    Route::post('/getSpecDocs', 'getSpecDoctors')       ->name('booking.specDoctors');
    Route::post('/getDocApps', 'getDocAppointments')    ->name('booking.docApps');
    Route::post('/createApp', 'create')                 ->name('booking.create');

    Route::get('/myappointments', 'myapps')             ->name('booking.appointments');
    Route::get('/cancelApp/{app}', 'cancelApp')         ->name('booking.cancel');
});

Route::middleware(['auth', 'isDoctor'])->controller(\App\Http\Controllers\DoctorApp\AppointmentController::class)->group(function () {
    Route::get('/todayApps', 'index')                   ->name('doctorApp.appointments');
});

Route::middleware(['auth'])->controller(\App\Http\Controllers\Booking\DoctorReportController::class)->group(function () {
    Route::get('/downloadDrReport/{app}', 'downloadReport')     ->name('docRep.download');
    Route::get('/createReport', 'create')                      ->name('docReport.create');
    Route::post('/editReport', 'edit')                          ->name('docReport.edit');
});

Route::middleware(['auth'])->controller(\App\Http\Controllers\Booking\PerscriptionController::class)->group(function () {
    Route::get('/downloadPerscription/{app}', 'downloadPerscription')     ->name('perscription.download');
    // Route::post('/createPerscription', 'create')                          ->name('perscription.create');
    // Route::post('/editPerscription', 'edit')                              ->name('perscription.edit');
});



// Route for testing purposes only

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
// Route::get('/testdoc', [\App\Http\Controllers\TestController::class, 'testdoc'])->name('prescription.download');
// Route::get('/testapp', [\App\Http\Controllers\TestController::class, 'testapp'])->name('docRep.download');
