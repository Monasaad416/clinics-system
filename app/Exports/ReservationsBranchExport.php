<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationsBranchExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $from_date,$to_date,$branch_id,$specialist_id,$doctor_id;
    public function __construct($from_date,$to_date,$branch_id,$specialist_id,$doctor_id){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branch_id = $branch_id;
        $this->specialist_id = $specialist_id;
        $this->doctor_id = $doctor_id;
    }
    public function collection()
    {
       
        $reservations = Reservation::where( function($query) {

            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('date', [$this->from_date,$this->to_date]);

                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }
            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);

            }
            if(!empty($this->specialist_id)){
                $query->where('specialist_id',$this->specialist_id);

            }

        })->where('branch_id',auth()->user()->branch_id)->where('status', 'completed')->latest()->paginate(20);

        return $reservations;
    }
}
