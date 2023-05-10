<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\SubSpecialist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDoctorRequest;

class DoctorController extends Controller
{
    public function getSubSpecialistsBySpecialist($specialist_id)
    {
        $subSpecialist = SubSpecialist::where('specialist_id',$specialist_id)->pluck('name_ar','id');
        return response()->json($subSpecialist);

    }
    public function index(Request $request, Branch $branch)
    {
        if($request->user()->roles_name == ["superadmin"]) {
            $doctors = Doctor::latest()->paginate(20);
            return view('admin.pages.doctors.index',compact('doctors'));
        }
        else{
          $doctors = Doctor::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
        return view('admin.pages.doctors.index',compact('doctors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {

        try {
                //return dd($request->all());
                DB::beginTransaction();
                if($request->professional_image){
                    $p_fileExtension = $request->professional_image->getClientOriginalExtension();
                    $p_fileName = time().'.'.$p_fileExtension;
                    $p_path = 'uploads/doctors';
                    $request->professional_image->move($p_path, $p_fileName);

                }

                if($request->title_image){
                    $t_fileExtension = $request->title_image->getClientOriginalExtension();
                    $t_fileName = time().('_').'.'.$t_fileExtension;
                    $t_path = 'uploads/doctors';
                    $request->title_image->move($t_path, $t_fileName);

                }


                if($request->image){
                    $profile_fileExtension = $request->image->getClientOriginalExtension();
                    $profile_fileName = time().'.'.$profile_fileExtension;
                    $profile_path = 'uploads/doctors';
                    $request->image->move($profile_path, $profile_fileName);
                }


                $doctor = Doctor::create([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'about_ar' => $request->about_ar,
                    'about_en' => $request->about_en,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'doctor_title_id' => $request->doctor_title_id,
                    'professional_title_id' => $request->professional_title_id ,
                    'fees' => $request->fees ? $request->fees : 0.00,
                    'discount_fees' => $request->discount_fees ? $request->discount_fees : 0.00,
                    'professional_image' => $p_fileName ?? null ,
                    'image' => $profile_fileName ?? null ,
                    'title_image' => $t_fileName ?? null ,
                    'branch_id' => $request->branch_id,
                    'specialist_id' => $request->specialist_id,
                    'first_come' => $request->first_come,
                    'stop_reservations' => $request->stop_reservations,
                    'salary' => $request->amount ? $request->amount : 0.00 ,
                ]);



            $doctor = Doctor::latest()->first();


            if($request->sub_specialist_ids){

                $subSpecialistsIds = [];
                //insert  into doctor_sub_specialists table
                foreach( $request->sub_specialist_ids as $id){
                    $subSpecialistsIds[] = $id;
                    $doctor->subSpecialists()->sync($subSpecialistsIds);
                }

            }


        if($request->day_ids){

            $newFrom1 = array_filter($request->from1);
            $newFrom2 = array_filter($request->from2);
            $keysOfNewFrom2 = array_keys($newFrom2);
            $keysOfDays = array_keys($request->day_ids);
            $newTo1 = array_filter($request->to1);
            $newTo2 =  array_filter($request->to2) ;
            $newReservations1 = array_filter($request->no_of_reservations1);
            $newReservations2 =  array_filter($request->no_of_reservations2);
            foreach ($request->day_ids as $id){

                Appointment::create([
                    'day_id'=> $id,
                    'doctor_id'=> $doctor->id,
                    'from' =>$newFrom1[$id-1] ,
                    'to' => $newTo1[$id-1],
                    'no_of_reservations' => $newReservations1[$id-1] ,
                ]);

                $idKey = $id -1;

                if($request->from2 != null ){
                    if(in_array( $idKey ,$keysOfNewFrom2)){
                        Appointment::create([
                            'day_id'=> $id,
                            'doctor_id'=> $doctor->id,
                            'from' =>$newFrom2[$id-1] ,
                            'to' => $newTo2[$id-1],
                            'no_of_reservations' => $newReservations2[$id-1] ,
                        ]);
                    }



                }
            }

        }



            DB::commit();
            return redirect()->route('admin.doctors.index')->with('success' ,'تم إضافة طبيب جديد بنجاح.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.pages.doctors.show',compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($request->user()->cannot('update', $doctor)) {
            abort(403);
        }

        $sSpecialistsIds =  DB::table('doctor_sub_specialist')->where('doctor_id', $id)->pluck('sub_specialist_id')->toArray();

        $daysIds =  Appointment::where('doctor_id',$id)->pluck('day_id')->toArray();

        return view('admin.pages.doctors.edit',compact(['doctor','sSpecialistsIds','daysIds']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
     //return dd($request->all());
      try {

            $doctor = Doctor::findOrFail($request->doctor_id);
            $doctor->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'about_ar' => $request->about_ar,
                'about_en' => $request->about_en,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'doctor_title_id' => $request->doctor_title_id,
                'fees' => $request->fees,
                'branch_id' => $request->branch_id,
                'salary' => $request->amount ? $request->amount : 0,
            ]);


            // if ($request->user()->cannot('update', $doctor)) {
            //     abort(403);
            // }
            //return dd($request->all());
            if($request->hasFile('professional_image')){

               if($doctor->professional_image){
                unlink(public_path('uploads/doctors/'. $doctor->professional_image));
               }

                $p_fileExtension = $request->professional_image->getClientOriginalExtension();
                $p_fileName = time().'.'.$p_fileExtension;
                $p_path = 'uploads/doctors';
                $request->professional_image->move($p_path, $p_fileName);
            }


            if($request->hasFile('title_image')){
                if($doctor->title_image){
                  unlink(public_path('uploads/doctors/'. $doctor->title_image));
                }


                $t_fileExtension = $request->title_image->getClientOriginalExtension();
                $t_fileName = time().('_').'.'.$t_fileExtension;
                $t_path = 'uploads/doctors';
                $request->title_image->move($t_path, $t_fileName);
            }

            if($request->has('image')) {
                if($doctor->image){
                    unlink(public_path('uploads/doctors/'. $doctor->image));
                }

                $profile_fileExtension = $request->image->getClientOriginalExtension();
                $profile_fileName = time().'.'.$profile_fileExtension;
                $profile_path = 'uploads/doctors';
                $request->image->move($profile_path, $profile_fileName);
            }


    


            if($request->hasFile('professional_image')){
                $doctor->update([
                    'professional_image' => $p_fileName,
                ]);
            }


            if($request->hasFile('image')){
                $doctor->update([
                    'image' => $profile_fileName,
                ]);
            }


            if($request->hasFile('title_image')){
                $doctor->update([
                    'title_image' => $t_fileName,
                ]);
            }


            //update doctor_sub_specialists table
            if($request->has('sub_specialist_ids')) {
                $doctor->subSpecialists()->sync($request->sub_specialist_ids);
            }


            //adjust appointments

            if($request->day_ids){
                $appointments = Appointment::where('doctor_id',$request->doctor_id)->delete();

                $newFrom1 = array_filter($request->from1);
                $newFrom2 = array_filter($request->from2);
                $keysOfNewFrom2 = array_keys($newFrom2);
                $keysOfDays = array_keys($request->day_ids);
                $newTo1 = array_filter($request->to1);
                $newTo2 =  array_filter($request->to2) ;
                $newReservations1 = array_filter($request->no_of_reservations1);
                $newReservations2 =  array_filter($request->no_of_reservations2);
                foreach ($request->day_ids as $id){

                    Appointment::create([
                        'day_id'=> $id,
                        'doctor_id'=> $doctor->id,
                        'from' =>$newFrom1[$id-1] ,
                        'to' => $newTo1[$id-1],
                        'no_of_reservations' => $newReservations1[$id-1] ,
                    ]);

                    $idKey = $id -1;

                    if($request->from2 != null ){
                        if(in_array( $idKey ,$keysOfNewFrom2)){
                            Appointment::create([
                                'day_id'=> $id,
                                'doctor_id'=> $doctor->id,
                                'from' =>$newFrom2[$id-1] ,
                                'to' => $newTo2[$id-1],
                                'no_of_reservations' => $newReservations2[$id-1] ,
                            ]);
                        }



                    }
                }
            }



            //update to salary table
            // if($request->has('salary')){
            //     $doctor->salary()->where('salariable_type','App\Models\Doctor')->where('salariable_id',$doctor->id)->update([
            //     'salariable_id' => $doctor->id,
            //     'amount' => $request->salary,
            //     'details' => 'الراتب',
            //      'branch_id' => $doctor->branch_id,
            // ]);

            // }


            if($request->hasFile('professional_image')){
                $doctor->images()->create([
                    'doctor_id' => $doctor->id,
                    'uploads' => $p_fileName,
                ]);
            }

            if($request->hasFile('title_image')){
                $doctor->images()->create([
                    'doctor_id' => $doctor->id,
                    'uploads' => $t_fileName,
                ]);
            }

            $subSpecialistsIds = [];
                       //insert  into doctor_sub_specialists table
            foreach( $request->input('sub_specialist_ids',[]) as $id){
                $subSpecialistsIds[] = $id;
                $doctor->subSpecialists()->sync($subSpecialistsIds);
            }





            return redirect()->route('admin.doctors.index')->with('update' ,'تم تحديث بيانات الطبيب بنجاح.');

      } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $doctor = Doctor::where('id',$request->id)->first();

        if ($request->user()->cannot('delete', $doctor)) {
            abort(403);
        }
        //remove image from storage


        unlink(public_path('uploads/doctors/'. $doctor->title_image));
        unlink(public_path('uploads/doctors/'. $doctor->professional_image));


        Salary::where('salariable_type','App\Models\Doctor')->where('salariable_id',$request->id)->first()->delete();

        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('delete' ,'تم حذف بيانات الطبيب  بنجاح.');
    }
}
