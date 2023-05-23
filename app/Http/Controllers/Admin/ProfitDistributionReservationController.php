<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Reservation;
use App\Models\ClinicProfit;
use App\Models\DoctorProfit;
use Illuminate\Http\Request;
use App\Models\CompanyProfit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use Illuminate\Support\Facades\Auth;

class ProfitDistributionReservationController extends Controller
{
    public function create($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        return view('admin.pages.profits_distributions_reservations.create',compact('reservation'));
    }


    public function store(Request $request)
    {
        try{

            $request->validate([
                'doctor_profit' => 'required|numeric',
                'company_profit' => 'nullable|numeric',
            ]);

            $reservation = Reservation::findOrFail($request->reservation_id);

            DB::beginTransaction();
            if(DoctorProfit::where('reservation_id',$reservation->id)->first() == null) {
                DoctorProfit::create([
                    'doctor_id' => $reservation->doctor_id,
                    'branch_id' => $reservation->branch_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->doctor_profit,
                    'notes' => 'ارباح كشف'
                ]);
            } else {
                $doctorProfit = DoctorProfit::where('reservation_id',$reservation->id)->first();
                $doctorProfit->update([
                    'doctor_id' => $reservation->doctor_id,
                    'branch_id' => $reservation->branch_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->doctor_profit,
                    'notes' => 'ارباح كشف'
                ]);

            }

            if($reservation->company_id) {   
                if(CompanyProfit::where('reservation_id',$reservation->id)->first() == null) {
                    CompanyProfit::create([
                        'company_id' => $reservation->company_id ?  $reservation->company_id :0 ,
                        'branch_id' => $reservation->branch_id,
                        'reservation_id' => $reservation->id,
                        'amount' => $request->doctor_profit,
                        'notes' => 'ارباح كشف'
                    ]);
                } else {
                    $companyProfit = CompanyProfit::where('reservation_id',$reservation->id)->first();
                    $companyProfit->update([
                        'company_id' => $reservation->company_id,
                        'branch_id' => $reservation->branch_id,
                        'reservation_id' => $reservation->id,
                        'amount' => $request->company_profit,
                        'notes' => 'ارباح كشف'
                    ]);

                }
            }




            if(ClinicProfit::where('reservation_id',$reservation->id)->first() == null) {
                ClinicProfit::create([
                    'branch_id' => $reservation->branch_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->clinic_profit,
                    'notes' => 'ارباح كشف'
                ]);
            } else {
                $clinicProfit = ClinicProfit::where('reservation_id',$reservation->id)->first();
                $clinicProfit->update([
                    'branch_id' => $reservation->branch_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->clinic_profit,
                    'notes' => 'ارباح كشف'
                ]);

            }


            DB::commit();
            if(Auth::user()->roles_name == ["superadmin"]){
                 return redirect()->route('livewire.clients_reservations_payments')->with('success' ,'تم إضافة سند القبض والارباح  بنجاح.');
            }
            else{
                 return redirect()->route('livewire.clients_reservations_payments_branch')->with('success' ,'تم إضافة سند القبض والارباح  بنجاح.');
            }



        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
