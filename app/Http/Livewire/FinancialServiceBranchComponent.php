<?php

namespace App\Http\Livewire;

use Excel;
use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\ServiceBooking;
use App\Exports\ServiceBookingsBranchExport;

class FinancialServiceBranchComponent extends Component
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
                 if(!empty($this->employee_id) ){
                $query->where('user_id',$this->employee_id);
            }

        })->where('branch_id',auth()->user()->branch_id)->paginate(20);


        return view('livewire.financial-service-branch-component', compact('serviceBookings','branches','specialists'));
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


        public function servicesBranch()
    {
        //return dd($this->from_date,$this->to_date,$this->branch_id,$this->sub_specialist_id,$this->specialist_id);
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $doctor_id = $this->doctor_id;
        $branch_id = auth()->user()->branch_id;
        $specialist_id = $this->specialist_id;

        return Excel::download(new ServiceBookingsBranchExport( $from_date,$to_date,$branch_id,$specialist_id,$doctor_id), 'services-branch.xlsx');
    }




}
