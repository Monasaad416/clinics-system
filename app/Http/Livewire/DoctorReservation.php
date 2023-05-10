<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Salary;

class DoctorReservation extends Component
{
    public $doctor;
    public $from_date;
    public $to_date;

    public function render()
    {
             $actualReservations = Reservation::where( function($query) {
                if(!empty($this->from_date) && !empty($this->to_date)  ){
                    $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
         
            })->where('status','completed')->where('doctor_id',$this->doctor->id)->sum('final_price');


       $payments = Salary::where( function($query) {

            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

            }

        })->where('salariable_type','App\Models\Doctor')->where('salariable_id',$this->doctor->id)->sum('amount');


        
        return view('livewire.doctor-reservation',['doctor'=>$this->doctor],compact('actualReservations','payments'));
    }
}


