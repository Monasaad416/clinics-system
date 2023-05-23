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
use App\Http\Controllers\Admin\CompanyController;
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
use App\Http\Controllers\Admin\SubSpecialistController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\Admin\DoctorAppointmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\ClientServicePaymentController;
use App\Http\Controllers\Admin\ClientReservationPaymentController;
use App\Http\Controllers\Admin\ProfitDistributionReservationController;
use App\Http\Controllers\Admin\ProfitDistributionServiceController;
use App\Http\Controllers\Admin\ServiceBookingController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Models\ServiceBooking;

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
Route::get('/admin/getEmployeesByBranch/{branch_id}', [ServiceBookingController::class, 'getEmployeesByBranch'])->name("getEmployeesByBranch");
Route::get('/admin/getClientByPhone/{phone}', [ServiceBookingController::class, 'getClientByPhone'])->name("getClientByPhone");


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
                'services_bookings' => ServiceBookingController::class,
                'offers' => OfferController::class,
                'payments' => PaymentController::class,
                'companies' => CompanyController::class,
            ]);

            Route::resource('specialists', SpecialistController::class)->except(['edit', 'update',]);
            Route::resource('sub_specialists', SubSpecialistController::class)->except(['edit', 'update',]);
            Route::resource('departments', DepartmentController::class)->except(['edit', 'update',]);
            Route::resource('branches', BranchController::class)->except(['create', 'store','delete']);


            Route::resource('sub_services', SubServiceController::class)->except(['edit', 'update',]);

            Route::get('/specialist/{slug}/edit',[SpecialistController::class,'editSpecialist'])->name('specialist.edit');
            Route::post('/specialist/{slug}/update',[SpecialistController::class,'updateSpecialist'])->name('specialist.update');

            Route::post('/branches/{id}/toggle-status',[BranchController::class,'toggleStataus'])->name('branches.toggle.status');
            Route::post('/companies/{id}/toggle-status',[CompanyController::class,'toggleStataus'])->name('companies.toggle.status');

            Route::get('/sub-specialist/{slug}/edit',[SubSpecialistController::class,'editSubSpecialist'])->name('sub_specialist.edit');
            Route::post('/sub-specialist/{slug}/update',[SubSpecialistController::class,'updateSubSpecialist'])->name('sub_specialist.update');

            Route::get('/department/{slug}/edit',[DepartmentController::class,'editDepartment'])->name('department.edit');
            Route::post('/department/{slug}/update',[DepartmentController::class,'updateDepartment'])->name('department.update');

            Route::get('/sub-service/{slug}/edit',[SubServiceController::class,'editSubServices'])->name('sub_services.edit');
            Route::post('/sub-service/{slug}/update',[SubServiceController::class,'updateSubServices'])->name('sub_services.update');


            Route::get('/clients_reservations_payments/create/{reservation_id}',[ClientReservationPaymentController::class,'create'])->name('clients_reservations_payments.create');
            Route::post('/clients_reservations_payments/store',[ClientReservationPaymentController::class,'store'])->name('clients_reservations_payments.store');
            Route::get('/clients_reservations_payments/edit/{payment_id}',[ClientReservationPaymentController::class,'edit'])->name('clients_reservations_payments.edit');
            Route::post('/clients_reservations_payments/update',[ClientReservationPaymentController::class,'update'])->name('clients_reservations_payments.update');
            Route::delete('/clients_reservations_payments/delete/{payment_id}',[ClientReservationPaymentController::class,'delete'])->name('clients_reservations_payments.destroy');
            Route::get('/client_reservations_payment/print/{payment_id}',[ClientReservationPaymentController::class,'print'])->name('clients_reservations_payments.print');

            // Route::get('/clients_services_payments/create/{reservation_id}',[ClientServicePaymentController::class,'create'])->name('clients_services_payments.create');
            // Route::post('/clients_services_payments/store',[ClientServicePaymentController::class,'store'])->name('clients_services_payments.store');
            Route::get('/reservations_profit_distributions/create/{reservation_id}',[ProfitDistributionReservationController::class,'create'])->name('profits_distributions_res.create');
            Route::post('/reservations_profit_distributions/store',[ProfitDistributionReservationController::class,'store'])->name('profits_distributions_res.store');


            Route::get('/services_profit_distributions/create/{service_booking_id}',[ProfitDistributionServiceController::class,'create'])->name('profits_distributions_serv.create');
            Route::post('/services_profit_distributions/store',[ProfitDistributionServiceController::class,'store'])->name('profits_distributions_serv.store');
            Route::get('/client_services_payment/print/{payment_id}',[ServiceBookingController::class,'print'])->name('clients_services_payments.print');

            // Route::get('/clients_services_payments/edit/{payment_id}',[ClientServicePaymentController::class,'edit'])->name('clients_services_payments.edit');
            // Route::post('/clients_services_payments/update',[ClientServicePaymentController::class,'update'])->name('clients_services_payments.update');






            Route::get('/settings/edit', [SettingController::class,'edit'])->name('settings.edit');
            Route::post('/settings/update', [SettingController::class,'update'])->name('settings.update');


            Route::get('/payment_type/{reservation_id}', [ReservationController::class,'SelectPaymentType'])->name('payment_type.select');
        });




    Route::post('/employee/restore/{id}',[EmployeeController::class,'restore'])->name('admin.employees.restore');
    Route::post('/employee/parmenent_delete/{id}',[EmployeeController::class,'parmenentDelete'])->name('admin.employees.parmenent_delete');


    // income from reservations
    Route::get('search-financial', [FinancialController::class,'income'])->name('search_front.financial_result');
    Route::get('search-payments', [PaymentController::class,'index'])->name('admin.search.payments');

    Route::get('financial-payments/export/', [Payment::class, 'export'])->name('payments_vouchers.excel');

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


Route::group(['middleware' => ['can:superadmin']], function () {
    Route::view('/admin/financial_results','livewire.show_financial')->name('financial_results');//تقارير الكشوفات
    Route::view('/admin/financial_distribution','livewire.show_financial_distribution')->name('financial_distribution');//توزيع ارباح الكشوفات
    Route::view('/admin/financial_services_distribution','livewire.show_financial_services_distribution')->name('financial_services_distribution');//توزيع ارباح الخدمات
    Route::view('/admin/financial_services_results','livewire.show_financial_services')->name('financial_services_results');//تقارير الخدمات    
    Route::view('/admin/financial_general_report','livewire.show_general_report')->name('financial_general_report');//تقرير ارباح وخسائر مجمع
    Route::view('/admin/payments_vouchers','livewire.show_payments')->name('payments_vouchers');//اذونات الصرف
    Route::view('/admin/clients_reservations_payments','livewire.show_clients_reservations_payments')->name('livewire.clients_reservations_payments');//اذونات دفع العملاء
    Route::view('/admin/clients_services_payments','livewire.show_clients_services_payments')->name('livewire.clients_services_payments');
});

    Route::view('/admin/clients_reservations_payments_branch','livewire.show_clients_reservations_payments_branch')->name('livewire.clients_reservations_payments_branch');
    Route::view('/admin/financial_results_branch','livewire.show_financial-branch')->name('financial_results_branch');//تقارير الكشوفات للفرع
    Route::view('/admin/financial_distribution_branch','livewire.show_financial_distribution_branch')->name('financial_distribution_branch');//توزيع ارباح الكشوفات للفرع
    Route::view('/admin/financial_services_distribution_branch','livewire.show_financial_services_distribution_branch')->name('financial_services_distribution_branch');//توزيع ارباح الخدمات للفرع

    Route::view('/admin/financial_services_results_branch','livewire.show_financial_services_branch')->name('financial_services_results_branch');//تقارير الخدمات للفرع
    Route::view('/admin/financial_general_report_branch','livewire.show_general_report_branch')->name('financial_general_report_branch');//تقرير ارباح وخسائر مجمع للفرع
    Route::view('/admin/payments_vouchers_branch','livewire.show_payments_branch')->name('payments_vouchers_branch');
    Route::view('/admin/clients_services_payments_branch','livewire.show_clients_services_payments_branch')->name('livewire.clients_services_payments_branch');




    // Route::view('financila_payments','livewire.show_payments2')->name('payments_vouchers2');
    // Route::view('financila_payments','livewire.show_payments3')->name('payments_vouchers3');
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
