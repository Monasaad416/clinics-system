<?php

namespace App\Http\Controllers\Front;

use Exception;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\User;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\SubSpecialist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreAppoinmemtRequest;
use App\Notifications\ReservationNotification;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    public function index()
    {
        $specialists = Specialist::select('name_'.LaravelLocalization::getCurrentLocale().' as name','id')->get();
        $branches = Branch::select('name_'.LaravelLocalization::getCurrentLocale().' as name','id')->get();
        //return dd($specialists);
        return view('front.pages.index',compact('specialists','branches'));
    }

    public function getSubSpecialistsBySpecialist($specialist_id)
    {

        $subSpecialist = SubSpecialist::where('specialist_id',$specialist_id)->pluck('name_'.LaravelLocalization::getCurrentLocale().' as name','id');
        return response()->json( $subSpecialist);
    }
    public function getDoctorsBySpecialistAndBranch($specialist_id,$branch_id)
    {
        $doctors = Doctor::where('specialist_id',$specialist_id)->where('branch_id',$branch_id)->pluck('name_'.LaravelLocalization::getCurrentLocale().' as name','id')->toArray();
        return response()->json( $doctors);
    }

    public function getDoctorsBySubSpecialistAndBranch($sub_specialist_id,$branch_id)
    {
        $doctorsWithSSpecialistIds = DB::table("doctor_sub_specialist")->where("sub_specialist_id",$sub_specialist_id)->pluck('doctor_id');

        $doctors = Doctor::whereIn('id',$doctorsWithSSpecialistIds)->where('branch_id',$branch_id)->pluck('name_'.LaravelLocalization::getCurrentLocale().' as name','id')->toArray();
        return response()->json( $doctors);
    }




    public function getDaysByDoctor($doctor_id)
    {
        $compined = DB::table('appointments')
        ->leftjoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->leftjoin('days', 'days.id', '=', 'appointments.day_id')
        ->where('doctor_id', $doctor_id)
        ->get();

            return response()->json( $compined);
    }


    public function getFeesByDoctor($doctor_id)
    {
        $fees = Doctor::where('id',$doctor_id)->pluck('fees','id')->toArray();
        return response()->json( $fees);
    }



    public function bookAppointment(StoreAppoinmemtRequest $request)
    {
        try{
            //return dd($request->all());
            $client = Client::where('phone',$request->phone)->first();
            //return dd($client);
            if(!$client){
             DB::beginTransaction();
                $latesClient = Client::orderBy('created_at','DESC')->first();
                if(!$latesClient){
                    $file_no = $request->branch_id.'#00000001';
                    } else {
                        $file_no = $request->branch_id.'#'.str_pad($latesClient->id + 1, 8, "0", STR_PAD_LEFT);
                    }

                $latesRes = Reservation::orderBy('created_at','DESC')->first();
                if(!$latesRes){

                $number = "B".$request->branch_id.'#00000001';
                } else {
                    $number = "B".$request->branch_id.'#'.str_pad($latesRes->id + 1, 8, "0", STR_PAD_LEFT);
                }

                    $client = Client::create([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'date_of_birth' => $request->date_of_birth,
                        'email' => $request->email,
                        'file_no' => $file_no,
                        'branch_id' => $request->branch_id,
                    ]);

                    Reservation::create([
                        'branch_id' => $request->branch_id,
                        'number' => $number,
                        'client_id' => $client->id,
                        'appointment_notes' => $request->day_id,
                        'doctor_id' => $request->doctor_id,
                        'sub_specialist_id' => $request->sub_specialist_id ? : null ,
                        'specialist_id' => $request->specialist_id,
                        'status' => 'pending',
                        'type' => $request->type,
                        'notes' => $request->notes,
                    ]);

                    $reservation = Reservation::latest()->first();
                    $admins = User::where('branch_id',$reservation->branch_id)->Where('roles_name','["reception"]')->get();

                    Notification::send($admins, new ReservationNotification($reservation));


                  DB::commit();
                     return redirect()->route('front.index')->with('success' ,trans('web.success_msg'));



            } else{

                    // $request->validate([
                    //     'branch_id' => 'required|exists:branches,id',
                    //     // 'time' => 'required',
                    //     // 'date' => 'required',
                    //     'doctor_id' => 'required|exists:doctors,id',
                    //  ]);
                     $client = Client::where('phone',$request->phone)->first();

                          //return dd($client);


                         $latesRes = Reservation::orderBy('created_at','DESC')->first();
                        if(!$latesRes){

                        $number = "B".$request->branch_id.'#00000001';
                        } else {
                            $number = "B".$request->branch_id.'#'.str_pad($latesRes->id + 1, 8, "0", STR_PAD_LEFT);
                        }
                        //return dd($request->all());
                        Reservation::create([
                        'branch_id' => $client->branch_id,
                        'number' => $number,
                        'client_id' => $client->id,
                        'appointment_notes' => $request->day_id,
                        'doctor_id' => $request->doctor_id,
                        'sub_specialist_id' => $request->sub_specialist_id ? : null,
                        'specialist_id' => $request->specialist_id,
                        'status' => 'pending',
                        'type' => $request->type,
                        'notes' => $request->notes,
                    ]);


                    $reservation = Reservation::latest()->first();
                    $admins = User::where('roles_name' , ["reception"])->where('branch_id',$reservation->branch_id)->get();
                    Notification::send($admins, new ReservationNotification($reservation));

                    return redirect()->route('front.index')->with('success' ,trans('web.success_msg'));


                }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    // public function messages()
    // {
    //     return [
    //
    //         'name_en.string' => trans('validation.string'),
    //         'name_en.max' => trans('validation.max'),
    //         'name_ar.required' => trans('validation.required'),
    //         'name_ar.string' => trans('validation.string'),
    //         'name_ar.max' => trans('validation.max'),
    //         'address_en.required' => trans('validation.required'),
    //         'address_en.string' => trans('validation.string'),
    //         'address_ar.required' => trans('validation.required'),
    //         'address_ar.string' => trans('validation.string'),
    //         'description_en.required' => trans('validation.required'),
    //         'description_en.string' => trans('validation.string'),
    //         'description_ar.required' => trans('validation.required'),
    //         'description_ar.string' => trans('validation.string'),
    //         'lattitude.required' => trans('validation.required'),
    //         'lattitude.numeric' => trans('validation.numeric'),
    //         'longitude.required' => trans('validation.required'),
    //         'longitude.numeric' => trans('validation.numeric'),
    //     ];
    // }



}
