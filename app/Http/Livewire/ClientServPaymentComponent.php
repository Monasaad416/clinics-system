<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\ServiceBooking;
use App\Exports\ClientServicePaymentsExport;
use App\Exports\ClientReservationPaymentExport;

class ClientServPaymentComponent extends Component
{

    public $specialist_id;
    public $doctor_id = null;
    public $employee_id = null;

    public $sub_specialist_id = null;
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

        $clientsServpayments = ServiceBooking::where( function($query) {

            $branchesIds = Branch::pluck('id')->toArray();
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

            if(!empty($this->specialist_id)){
                $query->where('specialist_id',$this->specialist_id);
            }

            // if(!empty($this->sub_specialist_id)){
            //     $query->where('sub_specialist_id',$this->sub_specialist_id);
            // }

            if(!empty($this->branch_id) ){
                $query->where('branch_id',$this->branch_id);
            }

        })->latest()->paginate(20);

        // $this->selectedPayments = $payments;

        //return dd($this->selectedPayments);
        return view('livewire.client-serv-payment-component',compact('clientsServpayments'));
    }


    public function updatedBranchId($branch_id)
    {
        if (!is_null($branch_id)) {
            $this->doctors = Doctor::where('branch_id', $this->branch_id)->get();
            $this->employees = User::where('branch_id', $this->branch_id)->whereNot('roles_name','["reception"]')->whereNot('roles_name','["superadmin"]')->get();
        }

    }



    public function updatedSpecialistId($specialist_id) {
        if (!is_null($specialist_id)) {
            $this->doctors = Doctor::where('specialist_id', $this->specialist_id)->get();
        }

    }








    public function exportClientServices()
    {
        //return dd($this->from_date,$this->to_date,$this->branch_id,$this->sub_specialist_id,$this->specialist_id);
        $from_date= $this->from_date;
        $to_date = $this->to_date;
        $sub_specialist_id = $this->sub_specialist_id;
        $doctor_id = $this->doctor_id;
        $branch_id = $this->branch_id;
        $specialist_id = $this->specialist_id;

        return Excel::download(new ClientServicePaymentsExport( $from_date,$to_date,$branch_id,$sub_specialist_id,$specialist_id,$doctor_id), 'clients-reservations-payments
        .xlsx');
    }


    }

