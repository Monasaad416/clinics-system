<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\ClinicProfit;
use App\Models\DoctorProfit;
use Illuminate\Http\Request;
use App\Models\CompanyProfit;
use App\Models\SubSpecialist;
use App\Models\EmployeeProfit;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceBookingRequest;

class ServiceBookingController extends Controller
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



    // public function index(Request $request)
    // {
    //      if($request->user()->roles_name == ["superadmin"]) {
    //         $reservations = ServiceBooking::latest()->paginate(20);
    //         return view('admin.pages.services_bookings.index',compact('reservations'));
    //     }
    //     else{
    //         $reservations = ServiceBooking::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
    //         return view('admin.pages.services_bookings.index',compact('reservations'));
    //     }
    // }


    public function create()
    {
        return view('admin.pages.services_bookings.create');
    }


    public function store(StoreServiceBookingRequest $request)
    {
       //return dd($request->all());
        $client = Client::where('phone',$request->phone)->first();
        // return dd($client);
        $latesRes = ServiceBooking::orderBy('created_at','DESC')->first();
        if(!$latesRes){

        $number = "S".$request->branch_id.'#00000001';
        } else {
            $number = "S".$request->branch_id.'#'.str_pad($latesRes->id + 1, 8, "0", STR_PAD_LEFT);
        }

        try{
            $client = Client::where('phone',$request->phone)->first();

            $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage : 0;
            // $doctor = Doctor::where('id',$request->doctor_id)->first();
            $servicePrice = $request->service_price ;
            $insuranceDisc = $servicePrice * $insurancePercentage /100 ;

            $finalPrice = $request->service_price - $insuranceDisc - $request->discount;


            ServiceBooking::create([
                'branch_id' => $request->branch_id,
                'number' => $number,
                'client_id' => $client->id,
                'time' => $request->time,
                'date' => $request->date,
                'doctor_id' => $request->doctor_id,
                'user_id' => $request->employee_id,
                'sub_specialist_id' => $request->sub_specialist_id,
                'specialist_id' => $request->specialist_id,
                'service_id' => $request->service_id,
                // 'status' => $request->status,
                'notes' => $request->notes,
                'payment_method_id' => $request->payment_method_id,
                'insurance' => $request->insurance,
                'insurance_discount' => $insuranceDisc,
                'insurance_percentage' => $insurancePercentage,
                'company_id' => $request->company_id,
                'service_price' => $request->service_price,
                'final_price' => $finalPrice,
             ]);


            $booking = ServiceBooking::latest()->first();





            // return redirect()->route('livewire.clients_services_payments')->with('success' ,'تم تأكيد حجز الخدمة بنجاح.');
            return redirect()->route('admin.profits_distributions_serv.create',$booking->id)->with('success' ,'تم تأكيد حجز الخدمة بنجاح.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }





    public function edit(Request $request,$id)
    {
        $serviceBooking = ServiceBooking::where('id',$id)->first();
        if ($request->user()->cannot('update', $serviceBooking)) {
            abort(403);
        }
        return view('admin.pages.services_bookings.edit',compact('serviceBooking'));
    }


   public function show(Request $request,$id)
    {
        $serviceBooking = ServiceBooking::where('id',$id)->first();
        if ($request->user()->cannot('view', $serviceBooking)) {
            abort(403);
        }
        return view('admin.pages.services_bookings.show',compact('serviceBooking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //return dd($request->all());
        $serviceBooking = ServiceBooking::where('id',$request->service_booking_id)->first();
        //return dd($serviceBooking);


        $client = Client::where('phone',$serviceBooking->client->phone)->first();
        //return dd($client);

            try{
                $insurancePercentage = $request->insurance_percentage ? $request->insurance_percentage : 0;
                // $doctor = Doctor::where('id',$request->doctor_id)->first();
                $servicePrice = $request->service_price ;
                $insuranceDisc = $servicePrice * $insurancePercentage /100 ;

                $finalPrice = $request->service_price - $insuranceDisc - $request->discount;


                 $serviceBooking->update([
                    'branch_id' => $request->branch_id,
                    'client_id' => $client->id,
                    'time' => $request->time,
                    'date' => $request->date,
                    'doctor_id' => $request->doctor_id,
                    'user_id' => $request->employee_id,
                    'sub_specialist_id' => $request->sub_specialist_id,
                    'specialist_id' => $request->specialist_id,
                    'service_id' => $request->service_id,
                    // 'status' => $request->status,
                    'notes' => $request->notes,
                    'payment_method_id' => $request->payment_method_id,
                    'insurance' => $request->insurance,
                    'insurance_discount' => $insuranceDisc,
                    'insurance_percentage' => $insurancePercentage,
                    'company_id' => $request->company_id,
                    'service_price' => $request->service_price,
                    'final_price' => $finalPrice,
                ]);


                return redirect()->route('admin.profits_distributions_serv.create',$serviceBooking->id)->with('update' ,'تم تحديث حجز الخدمة بنجاح.');
            } catch (Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }



    }




    public function getEmployeesByBranch($branch_id)
    {
        $employees = User::where('branch_id',$branch_id)->pluck('name','id')->toArray();
        return response()->json( $employees);
    }




    public function delete(Request $request)
    {
        $serviceBooking = ServiceBooking::where('id',$request->payment_id)->first();

        DoctorProfit::where('service_booking_id',$serviceBooking->id)->where('notes','ارباح خدمة')->delete();
        CompanyProfit::where('service_booking_id',$serviceBooking->id)->where('notes','ارباح خدمة')->delete();
        ClinicProfit::where('service_booking_id',$serviceBooking->id)->where('notes','ارباح خدمة')->delete();

        $serviceBooking->delete();

        return redirect()->route('livewire.clients_services_payments')->with('delete' ,'تم حذف حجز الخدمة والارباح التابعة له بنجاح.');
    }

    public function print(Request $request,$id)
    {
        $payment = ServiceBooking::findOrFail($request->payment_id);

        return view('admin.pages.services_bookings.print',compact('payment'));
    }



}
