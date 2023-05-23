<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\PaymentVoucher;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentVoucherExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $from_date,$to_date,$branch_id,$employee_id,$specialist_id,$doctor_id;
    public function __construct($from_date,$to_date,$branch_id,$employee_id,$specialist_id,$doctor_id){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branch_id = $branch_id;
        $this->employee_id = $employee_id;
        $this->specialist_id = $specialist_id;
        $this->doctor_id = $doctor_id;
    }




    public function collection()
    {
        //return dd($this->from_date,$this->to_date,$this->branch_id,$this->employee_id,$this->specialist_id);
     $payments = PaymentVoucher::where( function($query) {

                $branchesIds = Branch::pluck('id')->toArray();
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

            })->latest()->paginate(20);


        return $payments;
    }

}
