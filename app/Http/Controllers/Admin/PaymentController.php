<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Specialist;


use Illuminate\Http\Request;
use Excel;
use App\Exports\SalaryExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    protected function resourceAbilityMap()
    {
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'print' => 'print',
        ];
    }

protected function resourceMethodsWithoutModels()
{
    return ['print'];
}
   public function getNamesByJob($modelName,$branch_id) {
        if($modelName == 'Doctor') {
            $names = Doctor::where('branch_id',$branch_id)->pluck('name_ar','id')->toArray();
        } else{
            $names = User::get()->pluck('name','id')->toArray();
        }

        return response()->json( $names);
   }
   public function index(Request $request)
    {
        if(auth()->user()->roles_name == ["superadmin"]) {
            $pays = Salary::where( function($query) use ($request)  {

                $branchesIds = Branch::pluck('id')->toArray();
                $specialistsIds = Specialist::pluck('id')->toArray();
                $doctorsIds = Doctor::pluck('id')->toArray();

          
                if($request->doctor_id !==  null) {
                    $query->where('salariable_type','App\Models\Doctor')->where('salariable_id',$request->doctor_id);
                }

                if($request->employee_id !== null) {
                    $query->where('salariable_type','App\Models\User')->where('salariable_id',$request->employee_id);
                }
                if($request->branch_id !== null ) {
                    $query->where('branch_id',$request->branch_id);

                }
                if($request->specialist_id !==  null){
                    $doctorsWithSpecialist = Doctor::where('specialist_id' , $request->specialist_id)->pluck('id');
                    $query->where('salariable_type','App\Models\Doctor')->whereIn('salariable_id',$doctorsWithSpecialist);

                }
                if($request->from_date !==  null && $request->to_date !==  null){
                    $query->whereBetween('created_at', [$request->from_date,$request->to_date]);

                }

            });

             $paymentIds = $pays->pluck('id');
             $payments = $pays->latest()->paginate(20);
             $paymentIds = $request->session()->put('paymentIds', $payments );

            

            return view('admin.pages.payments.index',compact('payments'));
        }
        else{
            $payments = Salary::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
           
            return view('admin.pages.payments.index',compact('payments'));
        }





     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::pluck('name_ar','id');
        return view('admin.pages.payments.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $request->validate([
                'amount' => 'required|numeric',
                'details' => 'required|string',
            ]);
            //return dd($request->all());
            if($request->type_id == "doctor"){

            $doctor = Doctor::where('id',$request->employee_id)->first();
            //return dd($doctor);

            $doctor->salary()->create([
                'doctor_id' => $doctor->id,
                'amount' => $request->amount,
                'details' =>$request->details,
                'branch_id' => $doctor->branch_id,
            ]);
            } elseif($request->type_id == "user") {
            $user = User::where('id',$request->employee_id)->first();

            $user->salary()->create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'details' =>$request->details,
                'branch_id' =>$user->branch_id,
            ]);
         }


           DB::commit();
            return redirect()->route('financial_payments')->with('success' ,'تم إضافة سند صرف جديد بنجاح.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Request $request,$id)
    {
        $payment = Salary::findOrFail($id);
        if ($request->user()->cannot('update', $payment)) {
            abort(403);
        }

        return view('admin.pages.payments.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $payment = Salary::findOrFail($request->id);


            $request->validate([
                'amount' => 'required|numeric',
                'details' => 'required|string',
            ]);
          //  return dd($request->all());
            if($request->has('type_id') && $request->type_id == 'doctor'){

            $doctor = Doctor::findOrFail($request->employee_id);

            $doctor->salary()->update([
                'amount' => $request->amount,
                'details' =>$request->details
            ]);
            } elseif($request->has('type_id') && $request->type_id == 'user'){
            $user = User::findOrFail($request->employee_id);

            $user->salary()->update([

                'amount' => $request->amount,
                'details' =>$request->details
            ]);
         }

            return redirect()->route('admin.payments.index')->with('update' ,'تم تحديث سند الصرف بنجاح.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $salary = Salary::where('id',$request->id)->first();
        if ($request->user()->cannot('delete', $salary)) {
            abort(403);
        }

        $salary->delete();
        return redirect()->route('admin.payments.index')->with('delete' ,'تم حذف سند الصرف بنجاح.');
    }




    public function print(Request $request, $id)
    {
        $payment = Salary::findOrFail($id);

        if ($request->user()->cannot('delete', $payment)) {
            abort(403);
        }

        return view('admin.pages.payments.print', compact('payment'));
    }

    
 

    public function export(Request $request) 
    {
        // $pays = Salary::where( function($query) use ($request)  {

        //         $branchesIds = Branch::pluck('id')->toArray();
        //         $specialistsIds = Specialist::pluck('id')->toArray();
        //         $doctorsIds = Doctor::pluck('id')->toArray();

          
        //         if($request->doctor_id !==  null) {
        //             $query->where('salariable_type','App\Models\Doctor')->where('salariable_id',$request->doctor_id);
        //         }

        //         if($request->employee_id !== null) {
        //             $query->where('salariable_type','App\Models\User')->where('salariable_id',$request->employee_id);
        //         }
        //         if($request->branch_id !== null ) {
        //             $query->where('branch_id',$request->branch_id);

        //         }
        //         if($request->specialist_id !==  null){
        //             $doctorsWithSpecialist = Doctor::where('specialist_id' , $request->specialist_id)->pluck('id');
        //             $query->where('salariable_type','App\Models\Doctor')->whereIn('salariable_id',$doctorsWithSpecialist);

        //         }
        //         if($request->from_date !==  null && $request->to_date !==  null){
        //             $query->whereBetween('created_at', [$request->from_date,$request->to_date]);

        //         }

        //     });

        //      $paymentIds = $pays->pluck('id');
        //      $payments = $pays->latest()->paginate(20);
        //     //  $paymentIds = $request->session()->put('paymentIds', $payments );
      

        return Excel::download(new SalaryExport($request->from,$request->to) , 'payments.xlsx');
    }


}
