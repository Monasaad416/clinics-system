<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\ClientReservationPayment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientReservationPaymentExport implements FromCollection
{
    public $from_date,$to_date,$branch_id,$sub_specialist_id,$specialist_id,$doctor_id;

    public function __construct($from_date,$to_date,$branch_id,$sub_specialist_id,$specialist_id,$doctor_id){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branch_id = $branch_id;
        $this->sub_specialist_id = $sub_specialist_id;
        $this->specialist_id = $specialist_id;
        $this->doctor_id = $doctor_id;
    }
    public function collection()
    {
            $clientsReservationspayments = ClientReservationPayment::where( function($query) {

            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();

            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }

            if(!empty($this->specialist_id)){
                $query->where('specialist_id',$this->specialist_id);
            }

            if(!empty($this->sub_specialist_id)){
                $query->where('sub_specialist_id',$this->sub_specialist_id);
            }

            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }

        })->latest()->paginate(20);

   
        return $clientsReservationspayments;
    }
}
