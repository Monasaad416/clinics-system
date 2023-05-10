<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\SubSpecialist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;

class ReservationController extends Controller
{
    protected function resourceAbilityMap()
    {
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'print' => 'print',
        ];
    }

    protected function resourceMethodsWithoutModels()
    {
        return ['print'];
    }



    public function index(Request $request)
    {
         if($request->user()->roles_name == ["superadmin"]) {
            $reservations = Reservation::latest()->paginate(20);
            return view('admin.pages.reservations.index',compact('reservations'));
        }
        else{
            $reservations = Reservation::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
            return view('admin.pages.reservations.index',compact('reservations'));
        }
    }


    public function create()
    {
        return view('admin.pages.reservations.create');
    }


    public function store(StoreReservationRequest $request)
    {
        //return dd($request->all());
        $client = Client::where('phone',$request->phone)->first();
        // return dd($client);
        $latesRes = Reservation::orderBy('created_at','DESC')->first();
        if(!$latesRes){

        $number = "B".$request->branch_id.'#00000001';
        } else {
            $number = "B".$request->branch_id.'#'.str_pad($latesRes->id + 1, 8, "0", STR_PAD_LEFT);
        }
        if(!$client){

        try{

            DB::beginTransaction();

            //check reservation number

            //adjust client file no
            $latesClient = Client::orderBy('created_at','DESC')->first();
            if(!$latesClient){

                $file_no = $request->branch_id.'#00000001';
            } else {
                $file_no = $request->branch_id.'#'.str_pad($latesClient->id + 1, 8, "0", STR_PAD_LEFT);
            }


                //add new client
                $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'file_no' => $file_no,
                'branch_id' => $request->branch_id,
                ]);

                $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage :0;
                $doctor = Doctor::where('id',$request->doctor_id)->first();
                $doctorFees = $doctor->discount_fees > 0 ? $doctor->discount_fees : $doctor->fees;
                $insuranceDisc = $doctorFees * $insurancePercentage /100 ;

                //add reservation
                Reservation::create([
                'branch_id' => $request->branch_id,
                'number' => $number,
                'client_id' => $client->id,
                'time' => $request->time,
                'date' => $request->date,
                'doctor_id' => $request->doctor_id,
                // 'sub_specialist_id' => $request->sub_specialist_id,
                'specialist_id' => $request->specialist_id,
                'status' => $request->status,
                'type' => $request->type,
                'notes' => $request->notes,
                'payment_method_id' => $request->payment_method_id,
                'insurance' => $request->insurance,
                'insurance_discount' => $insuranceDisc,
                'insurance_percentage' => $insurancePercentage,
                'company_id' => $request->company_id,
                ]);


                $reservation = Reservation::latest()->first();
                $type = $reservation->type;

                //first visit fees
                // if ($type == 'first_visit') {
                //     $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                //     $insuranceDiscount = 0;
                //     $totalServicesPrice = 0;


                //     if($request->has('service_ids') ){
                //         $reservation->services()->sync($request->service_ids);
                //         $servicesIds = [];

                //         foreach($request->service_ids as $serv_id){
                //             $servicesIds[] = $serv_id;
                //             $price = Service::where('id',$serv_id)->first()->price;
                //             $totalServicesPrice += $price;

                //         }
                //     }

                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc + $servicesDiscount;
                //     }


                //     if($doctor->discount_fees > 0 ) {
                //         $reservation->final_price = $doctor->discount_fees + $totalServicesPrice - $insuranceDiscount;

                //         $reservation->save();
                //     } else {
                //         $reservation->final_price = $doctor->fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     }
                // } elseif($type == 'sec_visit') {
                //     $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                //     $insuranceDiscount = 0;
                //     $totalServicesPrice = 0;


                //     if($request->has('service_ids') ){
                //         $reservation->services()->sync($request->service_ids);
                //         $servicesIds = [];

                //         foreach($request->service_ids as $serv_id){
                //             $servicesIds[] = $serv_id;
                //             $price = Service::where('id',$serv_id)->first()->price;
                //             $totalServicesPrice += $price;

                //         }
                //     }


                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount =  $servicesDiscount;
                //     }


                //     $reservation->final_price = $totalServicesPrice - $insuranceDiscount;
                //     $reservation->save();

                // }



                DB::commit();
               //return dd($insuranceDiscount,$doctor->discount_fees , $totalServicesPrice);
                return redirect()->route('admin.reservations.index')->with('success' ,'تم إضافة العميل و تأكيد الحجز بنجاح.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


        } else{

            try{
                $client = Client::where('phone',$request->phone)->orWhere('email',$request->email)->first();

                $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage : 0;
                $doctor = Doctor::where('id',$request->doctor_id)->first();
                $doctorFees = $doctor->discount_fees > 0 ? $doctor->discount_fees : $doctor->fees;
                $insuranceDisc = $doctorFees * $insurancePercentage /100 ;

                Reservation::create([
                    'branch_id' => $request->branch_id,
                    'number' => $number,
                    'client_id' => $client->id,
                    'time' => $request->time,
                    'date' => $request->date,
                    'doctor_id' => $request->doctor_id,
                    'sub_specialist_id' => $request->sub_specialist_id,
                    'specialist_id' => $request->specialist_id,
                    'status' => $request->status,
                    'type' => $request->type,
                    'notes' => $request->notes,
                    'payment_method_id' => $request->payment_method_id,
                    'insurance' => $request->insurance,
                    'insurance_discount' => $insuranceDisc,
                    'insurance_percentage' => $insurancePercentage,
                    'company_id' => $request->company_id,
                ]);

                $reservation = Reservation::latest()->first();
                $type = $reservation->type;

                //first visit fees
                // if ($type == 'first_visit') {
                //     $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                //     $insuranceDiscount = 0;
                //     $totalServicesPrice = 0;


                //     if($request->has('service_ids') ){
                //         $reservation->services()->sync($request->service_ids);
                //         $servicesIds = [];

                //         foreach($request->service_ids as $serv_id){
                //             $servicesIds[] = $serv_id;
                //             $price = Service::where('id',$serv_id)->first()->price;
                //             $totalServicesPrice += $price;

                //         }
                //     }

                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc + $servicesDiscount;
                //     }


                //     if($doctor->discount_fees > 0 ) {
                //         $reservation->final_price = $doctor->discount_fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     } else {
                //         $reservation->final_price = $doctor->fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     }
                // } elseif($type== 'sec_visit') {
                //     $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                //     $insuranceDiscount = 0;
                //     $totalServicesPrice = 0;


                //     if($request->has('service_ids') ){
                //         $reservation->services()->sync($request->service_ids);
                //         $servicesIds = [];

                //         foreach($request->service_ids as $serv_id){
                //             $servicesIds[] = $serv_id;
                //             $price = Service::where('id',$serv_id)->first()->price;
                //             $totalServicesPrice += $price;

                //         }
                //     }

                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $servicesDiscount;
                //     }



                //         $reservation->final_price = $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();

                // }

                return redirect()->route('admin.reservations.index')->with('success' ,'تم تأكيد الحجز بنجاح.');
            } catch (Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

            }

    }


    public function show($id){
        $reservation = Reservation::where('id',$id)->first();
        return view('admin.pages.reservations.show',compact('reservation'));
    }


    public function edit(Request $request,$id)
    {
        $reservation = Reservation::where('id',$id)->first();
        if ($request->user()->cannot('update', $reservation)) {
            abort(403);
        }

        $subSpecialists = SubSpecialist::where('specialist_id', "=" , $reservation->doctor->specialist_id)->get();
       //return dd($subSpecialists)
        return view('admin.pages.reservations.edit',compact('reservation','subSpecialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //return dd($request->all());
        $reservation = Reservation::where('id',$request->id)->first();
        //return dd($reservation);


        $client = Client::where('phone',$reservation->client->phone)->first();
        //return dd($client);
        if(!$client){
        try{

            DB::beginTransaction();
            //adjust client file no
            $latesClient = Client::orderBy('created_at','DESC')->first();
            if(!$latesClient){

                $file_no = $request->branch_id.'#00000001';
                } else {
                    $file_no = $request->branch_id.'#'.str_pad($latesClient->id + 1, 8, "0", STR_PAD_LEFT);
                }

                //add new client
                $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'file_no' => $file_no,
                'branch_id' => $request->branch_id,
                ]);



                $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage : 0;
                $doctor = Doctor::where('id',$request->doctor_id)->first();
                $doctorFees = $doctor->discount_fees > 0 ? $doctor->discount_fees : $doctor->fees;
                $insuranceDisc = $doctorFees * $insurancePercentage /100 ;
                //add reservation
                $reservation->update([
                'branch_id' => $request->branch_id,
                'client_id' => $client->id,
                'time' => $request->time,
                'date' => $request->date,
                'doctor_id' => $request->doctor_id,
                'sub_specialist_id' => $request->sub_specialist_id,
                'specialist_id' => $request->specialist_id,
                'status' => $request->status,
                'type' => $request->type,
                'notes' => $request->notes,
                'payment_method_id' => $request->payment_method_id,
                'insurance' => $request->insurance,
                'insurance_discount' => $insuranceDisc,
                'insurance_percentage' => $insurancePercentage,
                'company_id' => $request->company_id,
                ]);

                $doctor = Doctor::where('id',$reservation->doctor_id)->first();
                $insuranceDiscount = 0;
                $totalServicesPrice = 0;


                // if ($reservation->type=='first_visit'){

                //     if($request->has('service_ids') ){
                //     $reservation->services()->sync($request->service_ids);
                //     $servicesIds = [];

                //     foreach($request->service_ids as $serv_id){
                //         $servicesIds[] = $serv_id;
                //         $price = Service::where('id',$serv_id)->first()->price;
                //         $totalServicesPrice += $price;

                //     }
                //     }

                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc + $servicesDiscount;
                //     }


                //     if($doctor->discount_fees > 0 ) {
                //         $reservation->final_price = $doctor->discount_fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     } else {
                //         $reservation->final_price = $doctor->fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     }

                // } elseif($reservation->type == 'sec_visit') {
                //    if($request->has('service_ids') ){
                //     $reservation->services()->sync($request->service_ids);
                //     $servicesIds = [];

                //     foreach($request->service_ids as $serv_id){
                //         $servicesIds[] = $serv_id;
                //         $price = Service::where('id',$serv_id)->first()->price;
                //         $totalServicesPrice += $price;

                //     }
                // }

                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc+$servicesDiscount;
                //     }



                //     $reservation->final_price =  $totalServicesPrice - $insuranceDiscount;
                //     $reservation->save();

                // }



                if($request->user()->notifications->count() > 0){

                }


                DB::commit();

                return redirect()->route('admin.reservations.index')->with('success' ,'تم إضافة العميل و تأكيد الحجز بنجاح.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


        } else{
            try{
                $client = Client::where('phone',$reservation->client->phone)->first();
                $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage :0;
                $doctor = Doctor::where('id',$request->doctor_id)->first();
                $doctorFees = $doctor->discount_fees > 0 ? $doctor->discount_fees : $doctor->fees;
                $insuranceDisc = $doctorFees * $insurancePercentage /100 ;


                 $reservation->update([
                    'branch_id' => $request->branch_id,
                    'client_id' => $client->id,
                    'time' => $request->time,
                    'date' => $request->date,
                    'doctor_id' => $request->doctor_id,
                    'sub_specialist_id' => $request->sub_specialist_id,
                    'specialist_id' => $request->specialist_id,
                    'status' => $request->status,
                    'type' => $request->type,
                    'notes' => $request->notes,
                    'payment_method_id' => $request->payment_method_id,
                    'insurance' => $request->insurance,
                    'insurance_discount' => $insuranceDisc,
                    'insurance_percentage' => $insurancePercentage,
                    'company_id' => $request->company_id,

                ]);


                $doctor = Doctor::find($request->doctor_id);
                $insuranceDiscount = 0;
                $totalServicesPrice = 0;


                // if ($reservation->type=='first_visit'){
                //     if($request->has('service_ids') ){
                //     $servicesIds = [];
                //     foreach($request->service_ids as $id){
                //         $servicesIds[] = $id;

                //         $reservation->services()->sync($servicesIds);
                //         $price = Service::where('id',$id)->first()->price;
                //         $totalServicesPrice += $price;

                //     }
                //     }
                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc+$servicesDiscount;
                //     }


                //     if($doctor->discount_fees > 0 ) {
                //         $reservation->final_price = $doctor->discount_fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();

                //     } else {
                //         $reservation->final_price = $doctor->fees + $totalServicesPrice - $insuranceDiscount;
                //         $reservation->save();
                //     }
                // } elseif($reservation->type == 'sec_visit') {
                //     if($request->has('service_ids') ){
                //     $servicesIds = [];
                //     foreach($request->service_ids as $id){
                //         $servicesIds[] = $id;

                //         $reservation->services()->sync($servicesIds);
                //         $price = Service::where('id',$id)->first()->price;
                //         $totalServicesPrice += $price;

                //     }
                //     }
                //     if($request->has('insurance_percentage')){
                //         $servicesDiscount = $totalServicesPrice * $insurancePercentage / 100;
                //         $insuranceDiscount = $insuranceDisc + $servicesDiscount;
                //     }


                //     $reservation->final_price =  $totalServicesPrice - $insuranceDiscount;
                //     $reservation->save();
                // }



                return redirect()->route('admin.reservations.index')->with('update' ,'تم تحديث الحجز بنجاح.');
            } catch (Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $resevation = Reservation::where('id',$id)->first();

        if ($request->user()->cannot('delete', $resevation)) {
            abort(403);
        }

        $resevation->delete();
        return redirect()->route('admin.reservations.index')->with('delete' ,'تم حذف الحجز بنجاح.');
    }


    // public function getDoctorsByBranch($branch_id)
    // {
    //     $doctors = Doctor::where('branch_id',$branch_id)->pluck('name_ar','id')->toArray();
    //     return response()->json( $doctors);
    // }

    public function getServicesByBranch($branch_id)
    {
        $services = Service::where('branch_id',$branch_id)->pluck('name_ar','id')->toArray();
        return response()->json( $services);
    }

        public function getSubSpecialistsBySpecialist($specialist_id)
    {
        $subSpecialist = SubSpecialist::where('specialist_id',$specialist_id)->pluck('name_ar','id');
        return response()->json( $subSpecialist);

    }

    public function getDoctorsBySubSpecialistAndBranch($sub_specialist_id,$branch_id)
    {
        $doctorsWithSSpecialistIds = DB::table("doctor_sub_specialist")->where("sub_specialist_id",$sub_specialist_id)->pluck('doctor_id')->toArray();

        $doctors = Doctor::whereIn('id',$doctorsWithSSpecialistIds)->where('branch_id',$branch_id)->pluck('name_ar','id');
        return response()->json( $doctors);
    }

    public function getDoctorsBySpecialistAndBranch($specialist_id,$branch_id)
    {
        $doctors = Doctor::where('specialist_id',$specialist_id)->where('branch_id',$branch_id)->pluck('name_ar','id');
        return response()->json( $doctors);
    }

    public function print(Request $request,$id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($request->user()->cannot('print', $reservation)) {
            abort(403);
        }
        return view('admin.pages.reservations.print',compact('reservation'));
    }



    public function SelectPaymentType($reservation_id)
    {
         $reservation = Reservation::findOrFail($reservation_id);
        return view('admin.pages.reservations.payment_type',compact('reservation'));
    }




}
