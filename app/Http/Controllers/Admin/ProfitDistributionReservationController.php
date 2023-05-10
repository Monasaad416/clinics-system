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
                    'reservation_id' => $reservation->id,
                    'amount' => $request->doctor_profit,
                    'notes' => 'ارباح كشف'
                ]);
            } else {
                $doctorProfit = DoctorProfit::where('reservation_id',$reservation->id)->first();
                $doctorProfit->update([
                    'doctor_id' => $reservation->doctor_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->doctor_profit,
                    'notes' => 'ارباح كشف'
                ]);
                
            }

            if(CompanyProfit::where('reservation_id',$reservation->id)->first() == null) {
                CompanyProfit::create([
                    'company_id' => $reservation->company_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->doctor_profit,
                    'notes' => 'ارباح كشف'
                ]);
            } else {
                $companyProfit = CompanyProfit::where('reservation_id',$reservation->id)->first();
                $companyProfit->update([
                    'company_id' => $reservation->company_id,
                    'reservation_id' => $reservation->id,
                    'amount' => $request->company_profit,
                    'notes' => 'ارباح كشف'
                ]);
                
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
            return redirect()->route('livewire.clients_reservations_payments')->with('success' ,'تم إضافة سند القبض والارباح  بنجاح.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editDepartment(Branch $branch, Department $department, Request $request , $slug ,)
    {
         $reservation = Reservation::where('id',$id)->first();
        if ($request->user()->cannot('update', $reservation)) {
            abort(403);
        }

        return view('admin.pages.profits_distributions_res.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateDepartment(Request $request)
    {
        try{
            $department = Department::where('slug',$request->slug)->first();


        if ($request->user()->cannot('update', $department)) {
            abort(403);
        }
            $department->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' =>Str::slug($request->name_en),
                'branch_id' => $request->branch_id,
            ]);

            return redirect()->route('admin.profits_distributions_reservations.index')->with('update' ,'تم تحديث بيانات القسم بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
