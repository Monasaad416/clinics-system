<?php

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Livewire\Payment;
use App\Http\Livewire\AddDoctor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DoctorController;

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FinancialController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\Financial1Controller;
use App\Http\Controllers\Admin\Financial2Controller;
use App\Http\Controllers\Admin\Financial3Controller;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ClientPaymentController;
use App\Http\Controllers\Admin\SubSpecialistController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DoctorAppointmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Client\HomeController as ClientHomeController;


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

Route::get('/admin/getSubSpecialistsBySpecialist/{specialist_id}', [DoctorController::class, 'getSubSpecialistsBySpecialist'])->name("getSubSpecialistsBySpecialist");
Route::get('/admin/getDoctorsByBranch/{branch_id}', [ReservationController::class, 'getDoctorsByBranch'])->name("getDoctorsByBranch");
Route::get('/admin/getDepartmentsByBranch/{branch_id}', [RegisteredUserController::class, 'getDepartmentsByBranch'])->name("getDepartmentsyBranch");
Route::get('/admin/getServicesByBranch/{branch_id}', [ReservationController::class, 'getServicesByBranch'])->name("getServicesByBranch");
Route::get('/admin/getNamesByJob/{modelName}/{branch_id}', [PaymentController::class, 'getNamesByJob'])->name("getNamesByJob");
Route::get('/admin/getFeesByDoctor/{doctor_id}', [ClientPaymentController::class, 'getFeesByDoctor'])->name("getFeesByDoctor");


Route::get('/admin/getDoctorsBySubSpecialistAndBranch/{sub_specialist_id}/{branch_id}', [ReservationController::class, 'getDoctorsBySubSpecialistAndBranch']);
Route::get('/admin/getDoctorsBySpecialistAndBranch/{specialist_id}/{branch_id}', [ReservationController::class, 'getDoctorsBySpecialistAndBranch']);
Route::get('/admin/getDoctorsBySpecialistAndBranch/{specialist_id}/{branch_id}', [FinancialController::class, 'getDoctorsBySpecialistAndBranch']);
Route::get('/admin/getDaysByDoctor/{doctor_id}', [HomeController::class, 'getDaysByDoctor'])->name("getDaysByDoctor");

// Route::get('/',function(Request $request){
//         $host = $request->getHost();
//     return dd($host);
// });


    // Route::prefix('/admin/{branch_id}')->name('admin.{branch_name}')->group(function(){
    //     Route::resources([


    //     ]);
    // });
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'autoCheckPermissions' ]
], function(){
        Route::get('/admin',[HomeController::class,'index'])->middleware(['auth'])->name('index');
        Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function(){
            Route::resources([
                'employees' => EmployeeController::class,
                'doctors' => DoctorController::class,
                'roles' => RoleController::class,
                'clients' => ClientController::class,
                'services' => ServiceController::class,
                'appointments' => DoctorAppointmentController::class,
                'reservations' => ReservationController::class,
                'offers' => OfferController::class,
                'payments' => PaymentController::class,
            ]);

            Route::resource('specialists', SpecialistController::class)->except(['edit', 'update',]);
            Route::resource('sub_specialists', SubSpecialistController::class)->except(['edit', 'update',]);
            Route::resource('departments', DepartmentController::class)->except(['edit', 'update',]);
            Route::resource('branches', BranchController::class)->except(['create', 'store','delete']);

            Route::resource('sub_services', SubServiceController::class)->except(['edit', 'update',]);

            Route::get('/specialist/{slug}/edit',[SpecialistController::class,'editSpecialist'])->name('specialist.edit');
            Route::post('/specialist/{slug}/update',[SpecialistController::class,'updateSpecialist'])->name('specialist.update');

            Route::post('/branches/{id}/toggle-status',[BranchController::class,'toggleStataus'])->name('branches.toggle.status');

            Route::get('/sub-specialist/{slug}/edit',[SubSpecialistController::class,'editSubSpecialist'])->name('sub_specialist.edit');
            Route::post('/sub-specialist/{slug}/update',[SubSpecialistController::class,'updateSubSpecialist'])->name('sub_specialist.update');

            Route::get('/department/{slug}/edit',[DepartmentController::class,'editDepartment'])->name('department.edit');
            Route::post('/department/{slug}/update',[DepartmentController::class,'updateDepartment'])->name('department.update');

            Route::get('/sub-service/{slug}/edit',[SubServiceController::class,'editSubServices'])->name('sub_services.edit');
            Route::post('/sub-service/{slug}/update',[SubServiceController::class,'updateSubServices'])->name('sub_services.update');

           
            Route::get('/clients_payments/create/{reservation_id}',[ClientPaymentController::class,'create'])->name('client_payment.create');
            Route::post('/clients_payments/store',[ClientPaymentController::class,'store'])->name('client_payment.store');

            Route::get('/clients_payments/edit/{payment_id}',[ClientPaymentController::class,'edit'])->name('clients_payments.edit');
            Route::post('/clients_payments/update',[ClientPaymentController::class,'update'])->name('clients_payments.update');

            Route::delete('/clients_payments/delete/{payment_id}',[ClientPaymentController::class,'delete'])->name('clients_payments.destroy');

            Route::get('/client_payment/print/{payment_id}',[ClientPaymentController::class,'print'])->name('clients_payments.print');

            Route::get('/settings/edit', [SettingController::class,'edit'])->name('settings.edit');
            Route::post('/settings/update', [SettingController::class,'update'])->name('settings.update');
        });

    Route::view('add_doctor','livewire.show_form');


    Route::post('/employee/restore/{id}',[EmployeeController::class,'restore'])->name('admin.employees.restore');
    Route::post('/employee/parmenent_delete/{id}',[EmployeeController::class,'parmenentDelete'])->name('admin.employees.parmenent_delete');


    // income from reservations
    Route::get('search-financial', [FinancialController::class,'income'])->name('search_front.financial_result');
    Route::get('search-payments', [PaymentController::class,'index'])->name('admin.search.payments');

    Route::get('financial-payments/export/', [Payment::class, 'export'])->name('financial_payments.excel');

    Route::get('/admin/financial/view',[FinancialController::class,'index'])->name('admin.finantial.reservations-income');
    Route::get('/admin/financial-1/view',[Financial1Controller::class,'index'])->name('admin.finantial-1.reservations-income');
    Route::get('/admin/financial-2/view',[Financial2Controller::class,'index'])->name('admin.finantial-2.reservations-income');
    Route::get('/admin/financial-3/view',[Financial3Controller::class,'index'])->name('admin.finantial-3.reservations-income');
    Route::get('/admin/financial/search',[FinancialController::class,'search'])->name('admin.finantial.reservations-search');
    Route::get('/admin/financial/search-by-branch',[FinancialController::class,'searchByBranch'])->name('admin.finantial.reservations-search-by-branch');
    Route::get('/admin/financial-1/search',[Financial1Controller::class,'search'])->name('admin.finantial-1.reservations-search');
    Route::get('/admin/financial-2/search',[Financial2Controller::class,'search'])->name('admin.finantial-2.reservations-search');
    Route::get('/admin/financial-3/search',[Financial3Controller::class,'search'])->name('admin.finantial-3.reservations-search');
    Route::get('/admin/financial/payments/print/{id}',[PaymentController::class,'print'])->name('admin.payments.print');



    Route::get('/admin/financial/search',[FinancialController::class,'search'])->name('admin.finantial.reservations-search');

    Route::get('/reservations/invoice/print/{id}',[ReservationController::class,'print'])->name('admin.reservations.print');

    Route::get('/admin/all-notifications', [EmployeeController::class, 'getAllNotifications'])->name('admin.all.notifications');




    Route::view('/admin/financial_results','livewire.show_financial')->name('financial_results');
    Route::view('/admin/financial_results_branch','livewire.show_financial-branch')->name('financial_results_branch');


    // Route::view('financial_results2','livewire.show_financial2')->name('financial_results2');
    // Route::view('financial_results3','livewire.show_financial3')->name('financial_results3');

    Route::view('/admin/financial_payments','livewire.show_payments')->name('financial_payments');
    Route::view('/admin/financial_payments_branch','livewire.show_payments_branch')->name('financial_payments_branch');

    Route::view('/admin/clients_payments','livewire.show_clients_payments')->name('livewire.clients_payments');
    Route::view('/admin/clients_payments_branch','livewire.show_clients_payments_branch')->name('livewire.clients_payments_branch');


    // Route::view('financila_payments','livewire.show_payments2')->name('financial_payments2');
    // Route::view('financila_payments','livewire.show_payments3')->name('financial_payments3');


});





Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
        Route::prefix('/client')->name('client.')->group(function(){
            Route::get('/',[ClientHomeController::class,'index'])->name('index');


    });
});



// require __DIR__.'/employee.php';
require __DIR__.'/auth.php';
