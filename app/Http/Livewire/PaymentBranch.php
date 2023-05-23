<?php

namespace App\Http\Livewire;

use Excel;
use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use Livewire\Component;
use App\Models\Specialist;
use Livewire\WithPagination;

use App\Models\PaymentVoucher;
use App\Exports\PaymentVoucherBranchExport;

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

            $payments = PaymentVoucher::where( function($query) {

                $specialistsIds = Specialist::pluck('id')->toArray();
                $doctorsIds = Doctor::pluck('id')->toArray();

                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                    }
                if(!empty($this->doctor_id) ){
                    $query->where('doctor_id',$this->doctor_id);
                }

                if(!empty($this->employee_id) ){
                    $query->where('user_id',$this->employee_id);
                }

                if(!empty($this->branch_id) ){
                    $query->where('branch_id',$this->branch_id);

                }
                if(!empty($this->specialist_id)){
                    $doctorsWithSpecialist = Doctor::where('specialist_id' , $this->specialist_id)->pluck('id');
                    $query->whereIn('doctor_id',$doctorsWithSpecialist);

                }

            })->where('branch_id',auth()->user()->branch_id)->latest()->paginate(20);

            return view('livewire.payment-branch',compact('payments'));

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


    return Excel::download(new PaymentVoucherBranchExport( $from_date,$to_date,$branch_id,$employee_id,$specialist_id,$doctor_id), 'payments.xlsx');
    }

}
