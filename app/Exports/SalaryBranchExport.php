<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Specialist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalaryBranchExport implements FromCollection,WithHeadingRow
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
        $payments = Salary::where( function($query) {



                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                    }
                if(!empty($this->doctor_id) ){
                    $query->where('salariable_type','App\Models\Doctor')->where('salariable_id',$this->doctor_id);
                }

                if(!empty($this->employee_id) ){
                    $query->where('salariable_type','App\Models\User')->where('salariable_id',$this->employee_id);
                }
                if(!empty($this->branch_id) ){
                    $query->where('branch_id',$this->branch_id);

                }
                if(!empty($this->specialist_id)){
                    $doctorsWithSpecialist = Doctor::where('specialist_id' , $this->specialist_id)->pluck('id');
                    $query->where('salariable_type','App\Models\Doctor')->whereIn('salariable_id',$doctorsWithSpecialist);

                }

            })->latest()->paginate(20);

            return $payments;
    }


      public function model(array $row)
    {
        return new Salary([
            'الوظيفة'  => $row['salariable_type'],
            'قيمة سند الصرف' => $row['amount'],
            'السبب'    => $row['details'],
        ]);
    }


}
