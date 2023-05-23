<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Specialist;
use App\Models\PaymentVoucher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentVoucherBranchExport implements FromCollection,WithHeadings,WithMapping
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

            return $payments;
    }




   public function headings(): array
    {
        return [
            'id',
            'Doctor',
            'Employee',
            'amount',
            'details',
            'branch',
            'created_at'
        ];
    }



    public function map($member): array
    {
        return [
            $member->name,
            $member->team_number,
            $member->date_of_birth,
        ];
    }




}
