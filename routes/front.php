<?php

use App\Models\Reservation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!]
|
*/


Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'  ]
], function(){
        Route::prefix('/')->name('front.')->group(function(){
            Route::get('/',[HomeController::class,'index'])->name('index');
            Route::get('/front/getSubSpecialistsBySpecialist/{specialist_id}', [HomeController::class, 'getSubSpecialistsBySpecialist'])->name("getSubSpecialistsBySpecialist");
            
            Route::get('/front/getDoctorsBySpecialistAndBranch/{specialist_id}/{branch_id}', [HomeController::class, 'getDoctorsBySpecialistAndBranch'])->name("getDoctorsBySpecialistAndBranch");
            Route::get('/front/getDoctorsBySubSpecialistAndBranch/{sub_specialist_id}/{branch_id}', [HomeController::class, 'getDoctorsBySubSpecialistAndBranch'])->name("getDoctorsBySubSpecialistAndBranch");
            Route::get('/front/getDaysByDoctor/{doctor_id}', [HomeController::class, 'getDaysByDoctor'])->name("getDaysByDoctor");
            Route::get('/front/getFeesByDoctor/{doctor_id}', [HomeController::class, 'getFeesByDoctor'])->name("getFeesByDoctor");

            Route::post('/book-appointment', [HomeController::class, 'bookAppointment'])->name("bookAppointment");


    });
});




