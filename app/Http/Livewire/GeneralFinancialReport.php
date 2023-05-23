<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\Reservation;
use App\Models\ClinicProfit;
use App\Models\DoctorProfit;
use App\Models\CompanyProfit;
use App\Models\EmployeeProfit;
use App\Models\PaymentVoucher;
use App\Models\ServiceBooking;

class GeneralFinancialReport extends Component
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

        })->where('status', 'completed')->sum('reservation_price');



                        
        $serviceBookings = ServiceBooking::where( function($query) {

            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

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

        })->sum('final_price');


        $doctorsProfits = DoctorProfit::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }
            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }
        })->sum('amount');


        $employeesProfits = EmployeeProfit::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->employee_id) ){
                $query->where('user_id',$this->employee_id);
            }
            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }
        })->sum('amount');


        $companiesProfits = CompanyProfit::where( function($query) {
            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                }
            if(!empty($this->company_id) ){
                $query->where('company_id',$this->company_id);
            }
            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }
        })->sum('amount');

        $clinicsProfits = ClinicProfit::where( function($query) {
            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }
        })->sum('amount');


        $doctorsPayments = PaymentVoucher::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }
        })->whereNotNull('doctor_id')->sum('amount');

        
        $employeesPayments = PaymentVoucher::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }
        })->whereNotNull('user_id')->sum('amount');


        
        $otherPayments = PaymentVoucher::where( function($query) {
            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);
                }
            if(!empty($this->doctor_id) ){
                $query->where('doctor_id',$this->doctor_id);
            }
        })->whereNull('doctor_id')->whereNull('user_id')->sum('amount');



    

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


            if(!empty($this->from_date) && !empty($this->to_date)  ){
                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

            }

        })->sum('amount');


        return view('livewire.general-financial-report', compact('reservations','serviceBookings','doctorsProfits','employeesProfits','companiesProfits','clinicsProfits','payments','doctorsPayments','employeesPayments','otherPayments','branches','specialists'));
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

 

}