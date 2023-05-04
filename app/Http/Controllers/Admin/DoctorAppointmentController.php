<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\DoctorAppointment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDoctorRequest;

class DoctorAppointmentController extends Controller
{
     public function index()
    {
        $appointments = DoctorAppointment::latest()->paginate(20);
        return view('admin.pages.appointments.index',compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        try {

            return dd($request->all());
            //insert images
             $professionlPath = Storage::putFile("uploads/doctors",$request->p_image);


            if($request->hasFiile('title_image')) {
              $titlePath = Storage::putFile("uploads/doctors",$request->title_image);

                $doctor = Doctor::create([
                'first_name_ar' => $request->first_name_ar,
                'first_name_en' => $request->first_name_en,
                'last_name_ar' => $request->last_name_ar,
                'last_name_en' => $request->last_name_en,
                'about_ar' => $request->about_ar,
                'about_en' => $request->about_en,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'specialist_id' => $request->specialist_id,
                'doctor_title_id' => $request->doctor_title_id,
                'professional_title_id' => $request->professional_title_id,
                'fees' => $request->fees,
                'discount_fees' => $request->discount_fees,
                'professional_image' => $professionlPath,
                'title_image' => $titlePath,
             ]);
            } else {
                $doctor = Doctor::create([
                'first_name_ar' => $request->first_name_ar,
                'first_name_en' => $request->first_name_en,
                'last_name_ar' => $request->last_name_ar,
                'last_name_en' => $request->last_name_en,
                'about_ar' => $request->about_ar,
                'about_en' => $request->about_en,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'specialist_id' => $request->specialist_id,
                'doctor_title_id' => $request->doctor_title_id,
                'professional_title_id' => $request->professional_title_id,
                'fees' => $request->fees,
                'discount_fees' => $request->discount_fees,
                'professional_image' => $professionlPath,
             ]);
            }



            //insert to salary table
            $doctor->salary()->create([
                'doctor_id' => $doctor->id,
                'salary' => $request->salary,
            ]);

            //insert to doctor_sub_specialists table
            $doctor->subpecialists()->sync($request->sub_specialist_ids);


            //inser to doctor_appointments

            // $doctor->availableDays()->sync($request->days);





            //  $request->success = 'تم إضافة الطبيب بنجاح';



             $request->clearForm();
             $request->current_screen = 1;
             session()->flash("success", " تم إضافة طبيب جديد بنجاح ");
        }
        catch(Exception $e){
            session()->flash("error", "IProblem occured while adding information");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.pages.appointments.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{

            $doctor = Doctor::findOrFail($request->id);
            if($request->hasFile('image')) {

                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/appointments';
                $request->image->move($path, $fileName);


                $doctor->update([
                    'first_name_ar' => $request->first_name_ar,
                    'first_name_en' => $request->first_name_en,
                    'last_name_ar' => $request->last_name_ar,
                    'last_name_en' => $request->last_name_en,
                    'about_ar' => $request->about_ar,
                    'about_en' => $request->about_en,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'section_id' => $request->section_id,
                    'professional_title_id' => $request->professional_title_id,
                    'doctor_title_id' => $request->doctor_title_id,
                    'phone' => $request->phone,
                    'image' => $fileName,
                    'fees' => $request->fees,
                    'discount_fees' => $request->discount_fees,
                ]);
            } else {
                $doctor->update($request->all());
            }
            $doctor->salary()->create([
                'doctor_id' => $doctor->id,
                'salary' => $request->salary
            ]);


            return redirect()->route('admin.appointments.index')->with('update' ,'تم تحديث بيانات الطبيب بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Doctor::where('id',$id)->first();
        //remove image from storage

        $employee->delete();
        return redirect()->route('admin.appointments.index')->with('delete' ,'تم حذف بيانات الطبيب  بنجاح.');
    }
}
