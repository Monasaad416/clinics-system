<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\ClinicProfit;
use App\Models\DoctorProfit;
use Illuminate\Http\Request;
use App\Models\CompanyProfit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ClientReservationPayment;

class ClientReservationPaymentController extends Controller
{

    public function create($reservation_id)
    {
        $branches = Branch::pluck('name_ar','id');
        $reservation = Reservation::findOrFail($reservation_id);
        return view('admin.pages.clients_reservations_payments.create',compact('branches','reservation'));

    }



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

                    $doctor = Doctor::where('id',$reservation->doctor_ifinal_priced)->first();
                    $fees = $request->first_visit_fees;
                    $discount = $request->discount ? $request->discount : 0;
                    $paidAmount = $request->paid_amount ? $request->paid_amount : 0;

                   //dd($request->all());


                        $insurancePercentage = $reservation->insurance_percentage;
                        $insuranceDiscount = $fees * $insurancePercentage / 100;
                        $total = $fees - $discount - $insuranceDiscount;



                    if(ClientReservationPayment::where('reservation_id',$reservation->id)->first() == null) {
                        ClientReservationPayment::create([
                            'amount' => $total,
                            'discount' => $request->discount ? $request->discount : 0,
                            'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                            'notes' => $request->notes,
                            'branch_id'=> $reservation->branch_id,
                            'payment_method_id' => $request->payment_method_id,
                            'doctor_id' => $reservation->doctor_id,
                            'specialist_id' => $reservation->specialist_id,
                            'sub_specialist_id' => $reservation->sub_specialist_id,
                            'reservation_id' => $reservation->id,
                        ]);
                    } else {
                        $clientServicesPayment = ClientReservationPayment::where('reservation_id',$reservation->id)->first();
                        $clientServicesPayment->update([
                                'amount' => $total,
                                'discount' => $request->discount ? $request->discount :0,
                                'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                                'notes' => $request->notes,
                                'branch_id'=> $reservation->branch_id,
                                'payment_method_id' => $request->payment_method_id,
                                'doctor_id' => $reservation->doctor_id,
                                'specialist_id' => $reservation->specialist_id,
                                'sub_specialist_id' => $reservation->sub_specialist_id,
                        ]);
                    }

                    $reservation->status = 'completed';
                    $reservation->reservation_price =  $total;
                    $reservation->save();

                    DB::commit();
                    // return redirect()->route('livewire.clients_reservations_payments')->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
                    return redirect()->route('admin.profits_distributions_res.create',['reservation_id'=> $reservation->id])->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
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
                    $discount = $request->discount ? $request->discount : 0;
                    $paidAmount = $request->paid_amount ? $request->paid_amount: 0;

                    if($request->insurance_percentage > 0 ){
                        $insurancePercentage = $reservation->insurance_percentage;
                        $insuranceDiscount = $fees * $insurancePercentage / 100;
                        $total = $fees - $discount - $insuranceDiscount;
                    }
                    else {
                        $total = $fees - $discount;
                    }




                    if(ClientReservationPayment::where('reservation_id',$reservation->id)->first() == null) {
                        ClientReservationPayment::create([
                            'amount' => $total,
                            'discount' => $request->discount ? $request->discount :0,
                            'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                            'notes' => $request->notes,
                            'branch_id'=> $reservation->branch_id,
                            'payment_method_id' => $request->payment_method_id,
                            'doctor_id' => $reservation->doctor_id,
                            'specialist_id' => $reservation->specialist_id,
                            'sub_specialist_id' => $reservation->sub_specialist_id,
                            'reservation_id' => $reservation->id,
                        ]);
                    } else {
                        $clientServicesPayment = ClientReservationPayment::where('reservation_id',$reservation->id)->first();
                        $clientServicesPayment->update([
                                'amount' => $total,
                                'discount' => $request->discount ? $request->discount :0,
                                'remaining_amount' =>  $request->remaining_amount ? $request->remaining_amount :0,
                                'notes' => $request->notes,
                                'branch_id'=> $reservation->branch_id,
                                'payment_method_id' => $request->payment_method_id,
                                'doctor_id' => $reservation->doctor_id,
                                'specialist_id' => $reservation->specialist_id,
                                'sub_specialist_id' => $reservation->sub_specialist_id,
                        ]);
                    }


                    $reservation->status = 'completed';
                    $reservation->reservation_price = $total;
                    $reservation->save();

                    DB::commit();
                    // return redirect()->route('livewire.clients_reservations_payments')->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
                    return redirect()->route('admin.profits_distributions_res.create',['reservation_id'=> $reservation->id])->with('success' ,'تم إضافة سند قبض  للعميل جديد بنجاح.');
                }catch (Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }








            // if($request->service_ids){
            //     foreach($request->service_ids as $key => $service_id){
            //         ClientReservationPayment::create([
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
            }

    }





    public function delete(Request $request)
    {
        $payment = ClientReservationPayment::where('id',$request->payment_id)->first();
        $reservation_id =  $payment->reservation_id;

        DoctorProfit::where('reservation_id',$reservation_id)->where('notes','ارباح كشف')->delete();
        CompanyProfit::where('reservation_id',$reservation_id)->where('notes','ارباح كشف')->delete();
        ClinicProfit::where('reservation_id',$reservation_id)->where('notes','ارباح كشف')->delete();

        $payment->delete();

        return redirect()->route('livewire.clients_reservations_payments')->with('delete' ,'تم حذف سند القبض والارباح التابعة له بنجاح.');
    }


    public function getFeesByDoctor($doctor_id)
    {
        $fees = Doctor::where('id',$doctor_id)->pluck('fees','id')->toArray();
        return response()->json( $fees);
    }


    public function print(Request $request,$id)
    {
        $payment = ClientReservationPayment::findOrFail($request->payment_id);

        return view('admin.pages.clients_payments.print',compact('payment'));
    }
}
