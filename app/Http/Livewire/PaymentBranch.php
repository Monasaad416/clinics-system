<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use Livewire\Component;
use App\Models\Specialist;
use Livewire\WithPagination;
use App\Exports\SalaryExport;
use Excel;

class PaymentBranch extends Component
{
//    use WithPagination;
 
    public $specialist_id;
    public $doctor_id = null;
    
    public $employee_id = null;
    public $from_date = "";
    public $to_date = "";
    public $doctors;
    public $employees;
    public $specialists;
    public $branch_id = null;

    public function mount()
    {
        $this->specialists = Specialist::all();
        $this->doctors = collect();
    }

    public function render()
    {
        
        // if(auth()->user()->roles_name == ["superadmin"]) {            
        //     $payments = Salary::where( function($query) {

        //         $branchesIds = Branch::pluck('id')->toArray();
        //         $specialistsIds = Specialist::pluck('id')->toArray();
        //         $doctorsIds = Doctor::pluck('id')->toArray();

        //         if(!empty($this->from_date) && !empty($this->to_date)  ){
        //             $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

        //             }
        //         if(!empty($this->doctor_id) ){
        //             $query->where('salariable_type','App\Models\Doctor')->where('salariable_id',$this->doctor_id);
        //         }

        //         if(!empty($this->employee_id) ){
        //             $query->where('salariable_type','App\Models\User')->where('salariable_id',$this->employee_id);
        //         }
         
        //         if(!empty($this->specialist_id)){
        //             $doctorsWithSpecialist = Doctor::where('specialist_id' , $this->specialist_id)->pluck('id');
        //             $query->where('salariable_type','App\Models\Doctor')->whereIn('salariable_id',$doctorsWithSpecialist);

        //         }

        //     })->latest()->paginate(20);

        //     return view('livewire.payment',compact('payments'));
        // }
        // else{
              $payments = Salary::where( function($query) {

                // $branchesIds = Branch::pluck('id')->toArray();
                // $specialistsIds = Specialist::pluck('id')->toArray();
                // $doctorsIds = Doctor::pluck('id')->toArray();

                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                    }
                if(!empty($this->doctor_id) ){
                    $query->where('salariable_type','App\Models\Doctor')->where('salariable_id',$this->doctor_id);
                }

                if(!empty($this->employee_id) ){
                    $query->where('salariable_type','App\Models\User')->where('salariable_id',$this->employee_id);
                }
     
                if(!empty($this->specialist_id)){
                    $doctorsWithSpecialist = Doctor::where('specialist_id',$this->specialist_id)->pluck('id')->toArray();
                    $query->where('salariable_type','App\Models\Doctor')->whereIn('salariable_id',$doctorsWithSpecialist);

                }

            })->where('branch_id',auth()->user()->branch_id)->latest()->paginate(20);
            return view('livewire.payment-branch',compact('payments'));
        // }
    }




    public function updatedSpecialistId($specialist_id) {
     if (!is_null($specialist_id)) {
            $this->doctors = Doctor::where('specialist_id', $this->specialist_id)->get();
        }

    }


    public function exportBranch() 
    {
    //return dd($this->from_date,$this->to_date,$this->branch_id,$this->employee_id,$this->specialist_id);
    $from_date= $this->from_date;
    $to_date = $this->to_date;
    $employee_id = $this->employee_id;
    $doctor_id = $this->doctor_id;
    $branch_id = auth()->user()->branch_id;
    $specialist_id = $this->specialist_id;


        return Excel::download(new SalaryExport( $from_date,$to_date,$branch_id,$employee_id,$specialist_id,$doctor_id), 'payments.xlsx');
    }

}