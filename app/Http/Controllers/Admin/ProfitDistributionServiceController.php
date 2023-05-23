<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\ClinicProfit;
use App\Models\DoctorProfit;
use Illuminate\Http\Request;
use App\Models\CompanyProfit;
use App\Models\EmployeeProfit;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfitDistributionServiceController extends Controller
{
    public function create($serviceBooking_id)
    {
        $serviceBooking = ServiceBooking::findOrFail($serviceBooking_id);
        return view('admin.pages.profits_distributions_services.create',compact('serviceBooking'));
    }


    public function store(Request $request)
    {
        try{
            //return dd($request->all());

            $serviceBooking = ServiceBooking::findOrFail($request->service_booking_id);

            DB::beginTransaction();


            if($serviceBooking->doctor_id != null){
                //check if profit saved for doctor or not
                if(DoctorProfit::where('service_booking_id',$serviceBooking->id)->first() == null) {
                    DoctorProfit::create([
                        'doctor_id' => $serviceBooking->doctor_id,
                        'branch_id' => $serviceBooking->branch_id,
                        'service_booking_id' => $serviceBooking->id,
                        'amount' => $request->user_profit,
                        'notes' => 'ارباح خدمة',
                    ]);
                } else {
                    $doctorProfit = DoctorProfit::where('service_booking_id',$serviceBooking->id)->first();
                    $doctorProfit->update([
                        'doctor_id' => $serviceBooking->doctor_id,
                        'branch_id' => $serviceBooking->branch_id,
                        'service_booking_id' => $serviceBooking->id,
                        'amount' => $request->user_profit,
                        'notes' => 'ارباح خدمة',
                    ]);
                }
            } else {


                    //check if profit saved for employee or not
                    if(EmployeeProfit::where('service_booking_id',$serviceBooking->id)->first() == null) {
                        //return dd($request->user_profit);
                        EmployeeProfit::create([
                            'branch_id' => $serviceBooking->branch_id,
                            'user_id' => $serviceBooking->user_id,
                            'service_booking_id' => $serviceBooking->id,
                            'amount' => $request->user_profit,
                            'notes' => 'ارباح خدمة',
                        ]);
                    } else {
                        $employeeProfit = EmployeeProfit::where('service_booking_id',$serviceBooking->id)->first();
                        $employeeProfit->update([
                            'branch_id' => $serviceBooking->branch_id,
                            'user_id' => $serviceBooking->user_id,
                            'service_booking_id' => $serviceBooking->id,
                            'amount' => $request->user_profit,
                            'notes' => 'ارباح خدمة',
                        ]);
                    }

            }


            if($serviceBooking->company_id != null){
                if(CompanyProfit::where('service_booking_id',$serviceBooking->id)->first() == null) {
                    CompanyProfit::create([
                        'branch_id' => $serviceBooking->branch_id,
                        'company_id' => $serviceBooking->company_id,
                        'service_booking_id' => $serviceBooking->id,
                        'amount' => $request->company_profit,
                        'notes' => 'ارباح خدمة',
                    ]);
                } else {
                    $companyProfit = CompanyProfit::where('service_booking_id',$serviceBooking->id)->first();
                    $companyProfit->update([
                        'branch_id' => $serviceBooking->branch_id,
                        'company_id' => $serviceBooking->company_id,
                        'service_booking_id' => $serviceBooking->id,
                        'amount' => $request->company_profit,
                        'notes' => 'ارباح خدمة',
                    ]);

                }
            }


            if(ClinicProfit::where('service_booking_id',$serviceBooking->id)->first() == null) {
                ClinicProfit::create([
                    'branch_id' => $serviceBooking->branch_id,
                    'service_booking_id' => $serviceBooking->id,
                    'amount' => $request->clinic_profit,
                    'notes' => 'ارباح خدمة',
                ]);
            } else {
                $clinicProfit = ClinicProfit::where('service_booking_id',$serviceBooking->id)->first();
                $clinicProfit->update([
                    'branch_id' => $serviceBooking->branch_id,
                    'service_booking_id' => $serviceBooking->id,
                    'amount' => $request->clinic_profit,
                    'notes' => 'ارباح خدمة',
                ]);

            }


            DB::commit();
            return redirect()->route('livewire.clients_services_payments')->with('success' ,'تم إضافة سند القبض والارباح  بنجاح.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}
