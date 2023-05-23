<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ClientPayment;
use App\Http\Controllers\Controller;
use App\Models\ClientReservationPayment;
use App\Models\ClientServicePayment;
use Illuminate\Support\Facades\DB;

class ClientPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return dd("ddddd");
    // }


    public function create($reservation_id)
    {
        $branches = Branch::pluck('name_ar','id');
        $reservation = Reservation::findOrFail($reservation_id);
        return view('admin.pages.clients_payments.create',compact('branches','reservation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $reservation = Reservation::findOrFail($request->reservation_id);
    //     if($request->selected_fees){
    //         $doctor = Doctor::where('id',$request->doctor_id)->first();
    //         ClientPayment::create([
    //             'paymentable_type' => 'App\Models\Reservaion' ,
    //             'paymentable_id'=> $request->reservation_id ,
    //             'amount' => $request->selected_fees == 1 ? $doctor->fees : $doctor->discount_fees,
    //             'remaining_amount' => $request->remaining_amount_res,
    //             'notes' => $request->notes,
    //             'branch_id'=> auth()->user()->branch_id,
    //             'payment_method_id' => $request->payment_method_id,
    //             'doctor_id' => $request->doctor_id,
    //             'specialist_id' => $request->specialist_id,
    //             'sub_specialist_id' => $request->sub_specialist_id,
    //             'reservation_id' => $request->reservation_id,
    //         ]);

    //         $reservation->status = 'completed';
    //         $reservation->save();
    //     }

    //     if($request->service_ids){
    //         foreach($request->service_ids as $key => $service_id){
    //             ClientPayment::create([
    //                 'paymentable_type' => 'App\Models\Service' ,
    //                 'paymentable_id'=> $service_id ,
    //                 'amount' => Service::where('id',$service_id)->first()->price,
    //                 'remaining_amount' => $key == 0 ? $request->remaining_amount_ser : 0,
    //                 'notes' => $request->notes,
    //                 'branch_id'=> auth()->user()->branch_id,
    //                 'payment_method_id' => $request->payment_method_id,
    //                 'doctor_id' => $request->doctor_id,
    //                 'specialist_id' => $request->specialist_id,
    //                 'sub_specialist_id' => $request->sub_specialist_id,
    //                 'reservation_id' => $request->reservation_id,
    //             ]);
    //         }

    //          $reservation->status = 'completed';
    //         $reservation->save();
    //     }
    //         return redirect()->route('admin.departments.index')->with('success' ,'تم إضافة معاملة مالية للعميل جديد بنجاح.');
    //     }


    public function store(Request $request)
    {
  

            if($request->selected_type == "firstVisit"){
                try{
                    //return dd($request->all());

                    DB::beginTransaction();
                    $reservation = Reservation::findOrFail($request->reservation_id);
                    $total  = 0 ;
                    $remainingfees = 0;
                    $insuranceDiscount = 0 ;

                    $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                    $fees = $request->first_visit_fees;
                    $servicesFees = $request->services_fees ? $request->services_fees : 0;
                    $discount = $request->discount ? $request->discount : 0;
                    $paidAmount = $request->paid_amount ? $request->paid_amount: 0;


                    if($request->has('insurance_percentage')){
                        $insurancePercentage = $reservation->insurance_percentage;
                        $insuranceDiscount = ($fees + $servicesFees) * $insurancePercentage / 100;
                        $total = $fees + $servicesFees - $discount - $insuranceDiscount;
                    }
                    else {
                        $total = $fees + $servicesFees - $discount;
                    }
                        

                    

                    
                    if(ClientServicePayment::where('reservation_id',$reservation->id)->first() == null) {
                        ClientServicePayment::create([
                            'amount' => $total,
                            'discount' => $request->discount ? $request->discount :0, 
                            'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                            'notes' => $request->txt,
                            'branch_id'=> $reservation->branch_id,
                            'payment_method_id' => $request->payment_method_id,
                            'doctor_id' => $reservation->doctor_id,
                            'specialist_id' => $reservation->specialist_id,
                            'sub_specialist_id' => $reservation->sub_specialist_id,
                            'reservation_id' => $reservation->id,
                        ]);
                    } else {
                        $clientServicesPayment = ClientServicePayment::where('reservation_id',$reservation->id)->first();
                        $clientServicesPayment->update([
                                'amount' => $total,
                                'discount' => $request->discount ? $request->discount :0, 
                                'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                                'notes' => $request->txt,
                                'branch_id'=> $reservation->branch_id,
                                'payment_method_id' => $request->payment_method_id,
                                'doctor_id' => $reservation->doctor_id,
                                'specialist_id' => $reservation->specialist_id,
                                'sub_specialist_id' => $reservation->sub_specialist_id,
                        ]);
                    }

                    $reservation->status = 'completed';
                    $reservation->final_price =  $total;
                    $reservation->insurance_discount = ($fees + $servicesFees) * $insurancePercentage / 100 ;
                    $reservation->save();

                    DB::commit();
                    return redirect()->route('livewire.clients_payments')->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
                }
                catch (Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }

            if($request->selected_type == "secVisit"){

                try{
                    //return dd($request->all());

                    DB::beginTransaction();
                    $reservation = Reservation::findOrFail($request->reservation_id);
                    $total  = 0 ;
                    $remainingfees = 0;

                    $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                    $fees = $request->sec_visit_fees;
                    $servicesFees = $request->services_fees;
                    $discount = $request->discount ? $request->discount : 0;
                    $paidAmount = $request->paid_amount ? $request->paid_amount: 0;
                   
                    if($request->has('insurance_percentage')){
                         $insurancePercentage = $reservation->insurance_percentage;
                        $insuranceDiscount = ($fees + $servicesFees) * $insurancePercentage / 100;
                        $total = $fees + $servicesFees - $discount - $insuranceDiscount;
                    }
                    else {
                        $total = $fees + $servicesFees - $discount;
                    }



                
                    if(ClientServicePayment::where('reservation_id',$reservation->id)->first() == null) {
                        ClientServicePayment::create([
                            'amount' => $total,
                            'discount' => $request->discount ? $request->discount :0, 
                            'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                            'notes' => $request->txt,
                            'branch_id'=> $reservation->branch_id,
                            'payment_method_id' => $request->payment_method_id,
                            'doctor_id' => $reservation->doctor_id,
                            'specialist_id' => $reservation->specialist_id,
                            'sub_specialist_id' => $reservation->sub_specialist_id,
                            'reservation_id' => $reservation->id,
                        ]);
                    } else {
                        $clientServicesPayment = ClientServicePayment::where('reservation_id',$reservation->id)->first();
                        $clientServicesPayment->update([
                                'amount' => $total,
                                'discount' => $request->discount ? $request->discount :0, 
                                'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                                'notes' => $request->txt,
                                'branch_id'=> $reservation->branch_id,
                                'payment_method_id' => $request->payment_method_id,
                                'doctor_id' => $reservation->doctor_id,
                                'specialist_id' => $reservation->specialist_id,
                                'sub_specialist_id' => $reservation->sub_specialist_id,
                        ]);

                    }

                    
               


                    $reservation->status = 'completed';
                    $reservation->final_price = $total;
                    $reservation->insurance_discount = ($fees + $servicesFees) * $insurancePercentage / 100  ;
                    $reservation->save();

                    DB::commit();
                    return redirect()->route('livewire.clients_payments')->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
                }catch (Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }



          



        
            // if($request->service_ids){
            //     foreach($request->service_ids as $key => $service_id){
            //         ClientServicePayment::create([
            //             'amount' => Service::where('id',$service_id)->first()->price,
            //             'remaining_amount' => $key == 0 ? $request->remaining_amount_ser : 0,
            //             'notes' => $request->notes,
            //             'branch_id'=> auth()->user()->branch_id,
            //             'payment_method_id' => $request->payment_method_id,
            //             'doctor_id' => $request->doctor_id,
            //             'specialist_id' => $request->specialist_id,
            //             'sub_specialist_id' => $request->sub_specialist_id,
            //             'reservation_id' => $request->reservation_id,
            //             'service_id' => $service_id,
            //              'type' => 'خدمة'
            //         ]);
            //     }

            //      $reservation->status = 'completed';
            //     $reservation->save();
            // }

    }

}






    public function edit( $payment_id)
    {
        $branches = Branch::pluck('name_ar','id');
        $payment = ClientServicePayment::findOrFail($payment_id);
        return view('admin.pages.clients_payments.edit',compact('payment','branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $payment = ClientServicePayment::findOrFail($request->payment_id);
        $reservation = Reservation::where('id',$payment->reservation->id)->first();
        $amountRes = 0 ;
        $amountServices = 0;


        if($request->selected_fees){
            $doctor = $payment->reservation->doctor;

            if( $request->selected_fees == 1){
                $amountRes = $doctor->fees ;
            } else {
                $amountRes = $doctor->discount_fees;
            }

        }


         if($request->service_ids){

            foreach($request->service_ids as $key => $service_id){
                $servive = Service::where('id',$service_id)->first();
                $amountServices += $servive->price;

            }
         }

            $payment->update([

                'amount' => $amountRes + $amountServices,
                'remaining_amount' => $request->remaining_amount,
                'notes' => $request->notes,
                'branch_id'=> $reservation->branch_id,
                'payment_method_id' => $request->payment_method_id,
                'doctor_id' => $reservation->doctor_id,
                'specialist_id' => $reservation->specialist_id,
                'sub_specialist_id' => $reservation->sub_specialist_id,
                'reservation_id' => $reservation->id,

            ]);

            return redirect()->route('livewire.clients_payments')->with('update' ,'تم تحديث سند القبض  للعميل  بنجاح.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        ClientServicePayment::where('id',$request->payment_id)->delete();

        return redirect()->route('livewire.clients_payments')->with('delete' ,'تم حذف سند القبض بنجاح.');
    }


    public function getFeesByDoctor($doctor_id)
    {
        $fees = Doctor::where('id',$doctor_id)->pluck('fees','id')->toArray();
        return response()->json( $fees);
    }


    public function print(Request $request,$id)
    {
        $payment = ClientServicePayment::findOrFail($request->payment_id);

        return view('admin.pages.clients_payments.print',compact('payment'));
    }
}
