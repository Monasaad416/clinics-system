<?php

namespace App\Http\Livewire;

use Excel;
use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Specialist;
use App\Exports\SalaryExport;
use App\Models\ClientServicePayment;
use App\Exports\ClientServicePaymentsExport;

class ClientPaymentBranch extends Component
{
    
    public $specialist_id;
    public $doctor_id = null;

    public $sub_specialist_id= null;
    public $from_date = "";

    public $to_date = "";
    public $branches;
    public $doctors;
    public $employees;
    public $specialists;
    protected $selectedPayments=[];

    public $branch_id;


    // public function mount()
    // {
    //     $this->branches = Branch::all();
    //     $this->doctors = collect();
    //     $this->employees = collect();
    //     $this->selectedPayments = collect();
    // }

    public function render()
    {

            $clientspayments = ClientServicePayment::where( function($query) {

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
     
            })->where('branch_id',auth()->user()->branch_id)->latest()->paginate(20);

            // $this->selectedPayments = $payments;

            //return dd($this->selectedPayments);
            return view('livewire.client-payment-branch',compact('clientspayments'));
    }


    // public function updatedBranchId($branch_id)
    // {
    //     if (!is_null($branch_id)) {
    //         $this->doctors = Doctor::where('branch_id', $this->branch_id)->get();
    //         $this->employees = User::where('branch_id', $this->branch_id)->get();
    //     }

    // }



    public function updatedSpecialistId($specialist_id) {
        if (!is_null($specialist_id)) {
            $this->doctors = Doctor::where('specialist_id', $this->specialist_id)->get();
        }

    }




    public function exportClientServicesBranch()
    {
        //return dd($this->from_date,$this->to_date,$this->branch_id,$this->sub_specialist_id,$this->specialist_id);
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $sub_specialist_id = $this->sub_specialist_id;
        $doctor_id = $this->doctor_id;
        $branch_id = auth()->user()->branch_id;
        $specialist_id = $this->specialist_id;

        return Excel::download(new ClientServicePaymentsExport( $from_date,$to_date,$branch_id,$sub_specialist_id,$specialist_id,$doctor_id), 'payments.xlsx');
    }

        
    }