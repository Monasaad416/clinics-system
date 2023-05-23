<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\PaymentVoucher;

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


       $payments = PaymentVoucher::where( function($query) {

            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

            }

        })->where('doctor_id',$this->doctor->id)->sum('amount');


        
        return view('livewire.doctor-reservation',['doctor'=>$this->doctor],compact('actualReservations','payments'));
    }
}


