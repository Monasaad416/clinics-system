<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Specialist;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinancialController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index(Request $request){
        $branches = Branch::all();
         $specialists = Specialist::all();
        $fees = 0;
        $insurance = 0;
        $net = 0;

        if($request->user()->roles_name == ["superadmin"] ) {
            $reservations = Reservation::where('status', 'completed')->latest()->paginate(20);
        }
        else{
         $reservations = Reservation::where('status', 'completed')->where('branch_id',auth()->user()->branch_id)->latest()->paginate(20);
        }


        $ServicesPrice = 0 ;
        $servicesInsurance  = 0;
        foreach ($reservations as $reservation) {
            $resServices = $reservation->services;
            if($reservation->insurance_percentage > 0) {
               foreach ( $resServices as $resService ) {
               $ServicesPrice += $resService->price;
               $servicesInsurance += $reservation->insurance_percentage /100 * $resService->price ; 
            }
            }   
        }

        
        $fees = $reservations->sum('final_price');
        foreach($reservations as $res){
            $insurance += $res->insurance_discount;
        }

        $payments= Salary::sum('amount');
        $totalInsurance = $insurance + $servicesInsurance;


        $net = $fees + $ServicesPrice - $servicesInsurance-$payments ;

        $netServices = $ServicesPrice - $servicesInsurance;

        

        return view('admin.pages.financial.index', compact('reservations','fees','payments','net','totalInsurance','branches','netServices','specialists'));
    }


    public function search(Request $request){
      //dd($request->all());
        $fees = 0;
        $insurance = 0;
        $net = 0;


        $branches = Branch::all();
        $specialists = Specialist::all();
       
        $reservations = Reservation::where( function($query) use ($request){

            $branchesIds = Branch::pluck('id')->toArray();
            $specialistsIds = Specialist::pluck('id')->toArray();
            $doctorsIds = Doctor::pluck('id')->toArray();

            if($request->doctor_id != null ){
                $query->where('doctor_id',$request->doctor_id);
            } 
            if($request->branch_id != null ){
                $query->where('branch_id',$request->branch_id);
            }
            if($request->specialist_id != null){
                $query->where('specialist_id',$request->specialist_id);
            }
            elseif($request->from != null && $request->to != null  ){
                 $query->whereBetween('date', [$request->from, $request->to]);
                 return $query;
            }
        })->where('status', 'completed')->paginate(20);
 
       //return dd($reservations);
            $fees = $reservations->sum('final_price');
            foreach($reservations as $res){
                $insurance += $res->insurance_discount;
            }

      

            $branchesIds = Branch::pluck('id')->toArray();
            if($request->has('from','to')){
                  $payments= Salary::whereBetween('created_at',[$request->from,$request->to])->sum('amount');

                $ServicesPrice = 0 ;
                $servicesInsurance  = 0;
                foreach ($reservations as $reservation) {
                    $resServices = $reservation->services()->whereBetween('services.created_at',[$request->from,$request->to])->get();
                    if($reservation->insurance_percentage > 0) {
                    foreach ( $resServices as $resService ) {
                    $ServicesPrice += $resService->price;
                    $servicesInsurance += $reservation->insurance_percentage /100 * $resService->price ; 
                    }
                    }   
                }

                $netServices = $ServicesPrice - $servicesInsurance;

                $net = $fees + $ServicesPrice - $servicesInsurance - $payments;

            }if(in_array($request->branch_id , $branchesIds)){
               $payments= Salary::whereBetween('created_at',[$request->from,$request->to])->where('branch_id',$request->branch_id)->sum('amount');
               //services 
                $ServicesPrice = 0 ;
                $servicesInsurance  = 0;
                foreach ($reservations as $reservation) {
                    $resServices = $reservation->services()->whereBetween('services.created_at',[$request->from,$request->to])->get();
                    if($reservation->insurance_percentage > 0) {
                    foreach ( $resServices as $resService ) {
                    $ServicesPrice += $resService->price;
                    $servicesInsurance += $reservation->insurance_percentage /100 * $resService->price ; 
                    }
                    }   
                }

                $netServices = $ServicesPrice - $servicesInsurance;

                $net = $fees + $ServicesPrice - $servicesInsurance - $payments;
            } else {
                $payments= Salary::sum('amount');

                foreach ($reservations as $reservation) {
                    $resServices = $reservation->services;
                    if($reservation->insurance_percentage > 0) {
                        foreach ( $resServices as $resService ) {
                            $ServicesPrice += $resService->price;
                            $servicesInsurance += $reservation->insurance_percentage /100 * $resService->price ; 
                        }
                    }   
                }

                $netServices = $ServicesPrice - $servicesInsurance;

                $net = $fees + $ServicesPrice - $servicesInsurance - $payments;
                
            }

 
                $branch_id = $request->branch_id ? $request->branch_id : '' ;
                 $from = $request->from ? $request->from : '' ;
                 $to = $request->to ? $request->to : '' ;
                 $specialist = $request->specialist_id ? Specialist::where('id',$request->specialist_id)->first() : '' ;
                 $doctor = $request->doctor_id ? Doctor::where('id',$request->doctor_id)->first() : '' ;
 
             // return redirect()->to($request->fullUrlWithQuery([]));
            
                $from= $request->from;
                $to = $request->to;
                $branch = Branch::where('id',$request->branch_id)->first();
         
 
                 return view('admin.pages.financial.search', compact('reservations','fees','payments','net','insurance','branches','branch','from','to','netServices','specialist','doctor'));
         
               


    }

    public function getDoctorsBySpecialistAndBranch($specialist_id,$branch_id)
    {
        $doctors = Doctor::where('branch_id',$branch_id)->where('specialist_id',$specialist_id)->pluck('name_ar','id')->toArray();
        return response()->json( $doctors);
    }




}
