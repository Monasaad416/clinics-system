<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Salary;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Financial1Controller extends Controller
{
    public function index(Request $request){
        $branches = Branch::where('id',1)->first();
        $fees = 0;
        $insurance = 0;
        $net = 0;

        $reservations = Reservation::where('status', 'completed')->where('branch_id',auth()->user()->branch_id)->latest()->paginate(20);

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

        $payments= Salary::where('branch_id',1)->sum('amount');
        $totalInsurance = $insurance + $servicesInsurance;


        $net = $fees + $ServicesPrice - $servicesInsurance-$payments ;

        $netServices = $ServicesPrice - $servicesInsurance;

        

        return view('admin.pages.financial-1.index', compact('reservations','fees','payments','net','totalInsurance','branches','netServices'));
    }


    public function search(Request $request){
      //return dd($request->all());
        $fees = 0;
        $insurance = 0;
        $net = 0;


        $branches = Branch::all();
       
        $reservations = Reservation::where( function($query) use ($request){
            if($request->has('from','to')){
                 $query->whereBetween('date', [$request->from, $request->to])->where('status', 'completed');
            } else {
                 $query->where('status', 'completed');
            }
        })->paginate(20);

        // return dd($reservations);
            $fees = $reservations->sum('final_price');
            foreach($reservations as $res){
                $insurance += $res->insurance_discount;
            }

    
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

            } 

                $netServices = $ServicesPrice - $servicesInsurance;

                $net = $fees + $ServicesPrice - $servicesInsurance - $payments;
                
           

 
               $branch_id = 1  ;
                 $from = $request->from ? $request->from : '' ;
                 $to = $request->to ? $request->to : '' ;
 
 
        // return redirect()->to($request->fullUrlWithQuery([]));
            
                $from= $request->from;
                $to = $request->to;
                $branch = Branch::where('id',1)->first();
         
 
                 return view('admin.pages.financial-1.search', compact('reservations','fees','payments','net','insurance','branches','branch','from','to','netServices'));
         
               


}



}
