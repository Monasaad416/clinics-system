<?php

namespace App\Http\Livewire;

use Excel;
use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Exports\SalaryExport;
use App\Models\PaymentVoucher;
use App\Exports\ReservationsExport;

class Financial extends Component
{
    // use WithPagination;
    public $branch_id;
    public $specialist_id;
    public $doctor_id;

    public $employee_id;
    public $from_date = "";
    public $to_date = "";
    public $doctors;
    public $employees;


    public function render()
    {

        $branches = Branch::all();
        $specialists = Specialist::all();
         $doctors = Doctor::all();
        $fees = 0;
        $insurance = 0;
        $net = 0;



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

        })->where('status', 'completed')->paginate(20);





        $ServicesPrice = 0 ;
        $servicesInsurance  = 0;
        // foreach ($reservations as $reservation) {
        //     $resServices = $reservation->services;
        //     if($reservation->insurance_percentage > 0) {
        //        foreach ( $resServices as $resService ) {
        //        $ServicesPrice += $resService->price;
        //        $servicesInsurance += $reservation->insurance_percentage /100 * $resService->price ;
        //     }
        //     }
        // }


        $fees = $reservations->sum('final_price');
        foreach($reservations as $res){
            $insurance += $res->insurance_discount;
        }






        $payments = PaymentVoucher::where( function($query) {

            // $branchesIds = Branch::pluck('id')->toArray();
            // $specialistsIds = Specialist::pluck('id')->toArray();
            // $doctorsIds = Doctor::pluck('id')->toArray();
            if(!empty($this->branch_id)  ){
                 $query->where('branch_id',$this->branch_id);

            }
            if(!empty($this->doctor_id) ){
                  $query->where('doctor_id',$this->doctor_id);
            }


            if(!empty($this->employee_id) ){
                $query->where('user_id',$this->employee_id);
            }

            if(!empty($this->specialist_id)){
                $doctorsWithSpecialist = Doctor::where('specialist_id',$this->specialist_id)->pluck('id')->toArray();
                $query->whereIn('doctor_id',$doctorsWithSpecialist);

            }

            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

            }

        })->sum('amount');

        $totalInsurance = $insurance + $servicesInsurance;


        $net = $fees + $ServicesPrice - $servicesInsurance-$payments ;

        $netServices = $ServicesPrice - $servicesInsurance;

        return view('livewire.financial', compact('reservations','doctors','fees','payments','net','totalInsurance','branches','netServices','specialists'));
    }




    public function updatedBranchId($branch_id)
    {
        if (!is_null($branch_id)) {
            $this->doctors = Doctor::where('branch_id', $this->branch_id)->get();
            $this->employees = User::where('branch_id', $this->branch_id)->get();
        }

    }


    public function updatedSpecialistId($specialist_id)
    {
     if (!is_null($specialist_id)) {
            $this->doctors = Doctor::where('specialist_id', $this->specialist_id)->get();
        }
    }


    public function reservations()
    {
        //return dd($this->from_date,$this->to_date,$this->branch_id,$this->sub_specialist_id,$this->specialist_id);
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $doctor_id = $this->doctor_id;
        $branch_id = $this->branch_id;
        $specialist_id = $this->specialist_id;

        return Excel::download(new ReservationsExport( $from_date,$to_date,$branch_id,$specialist_id,$doctor_id), 'reservations.xlsx');
    }



}
