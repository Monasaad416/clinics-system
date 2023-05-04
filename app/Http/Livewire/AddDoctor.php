<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Branch;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\DoctorTitle;
use App\Models\Day;
use App\Models\SubSpecialist;
use Livewire\WithFileUploads;
use App\Models\ProfessionalTitle;
use Illuminate\Support\Facades\Storage;

class AddDoctor extends Component
{
    use WithFileUploads;
    public $current_screen = 1;
    public $success='';
    public $first_name_en,$first_name_ar,
    $last_name_en,$last_name_ar,
    $about_en,$about_ar,
    $email,
    $phone,
    $gender,
    $branch_id,
    $p_image,
    $title_image,
    $doctor_title_id,
    $professional_title_id,$specialist_id,$sub_specialist_ids,
    $salary,$insurance,$insurance_percentage,$insurance_discount,
    $fees,$discount_fees, $days;
    
 
    public function firstStep()
    {
        $genders = Doctor::getGender();
        $this->validate([
            'first_name_en' => 'required|string|max:255',
            'first_name_ar' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'phone' => 'required|string',
            'gender' =>'required|numeric|in:'.implode(',',$genders),
            'email' => 'required|email|max:255|unique:users',
            'about_en' => 'required|string',
            'about_ar' => 'required|string',
        ]);

        $this->current_screen = 2;

    }

    public function secStep()
    {
        $this->validate([
            'professional_title_id' => 'required|exists:professional_titles,id',
            'doctor_title_id' => 'required|exists:doctor_titles,id',
            'p_image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            'title_image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
        ]);

        // return dd($this->all());
        $this->current_screen = 3;
    }


    public function back($current_screen)
    {
        $this->current_screen = $this->current_screen -1 ;
    }


       public function submitForm()
    {
        $this->validate([
            'branch_id' => 'required|exists:branches,id',
            'fees' => 'required|numeric',
            'discount_fees' => 'nullable|numeric',
        ]);
        try {

            
            //insert images
             $professionlPath = Storage::putFile("uploads/doctors",$this->p_image);

    
            if(!empty($this->title_image)) {
              $titlePath = Storage::putFile("uploads/doctors",$this->title_image);

                $doctor = Doctor::create([
                'first_name_ar' => $this->first_name_ar,
                'first_name_en' => $this->first_name_en,
                'last_name_ar' => $this->last_name_ar,
                'last_name_en' => $this->last_name_en,
                'about_ar' => $this->about_ar,
                'about_en' => $this->about_en,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'email' => $this->email,
                'specialist_id' => $this->specialist_id,
                'doctor_title_id' => $this->doctor_title_id,
                'professional_title_id' => $this->professional_title_id,
                'fees' => $this->fees,
                'discount_fees' => $this->discount_fees,
                'professional_image' => $professionlPath,
                'title_image' => $titlePath,
                'branch_id' => $request->branch_id
             ]);
            } else {
                $doctor = Doctor::create([
                'first_name_ar' => $this->first_name_ar,
                'first_name_en' => $this->first_name_en,
                'last_name_ar' => $this->last_name_ar,
                'last_name_en' => $this->last_name_en,
                'about_ar' => $this->about_ar,
                'about_en' => $this->about_en,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'email' => $this->email,
                'specialist_id' => $this->specialist_id,
                'doctor_title_id' => $this->doctor_title_id,
                'professional_title_id' => $this->professional_title_id,
                'fees' => $this->fees,
                'discount_fees' => $this->discount_fees,
                'professional_image' => $professionlPath,
             ]);
            }

         

            //insert to salary table
            $doctor->salary()->create([
                'doctor_id' => $doctor->id,
                'salary' => $this->salary,
            ]);

            //insert to doctor_sub_specialists table
            $doctor->subpecialists()->sync($this->sub_specialist_ids);


            //inser to doctor_appointments 

            // $doctor->availableDays()->sync($this->days);


            


            //  $this->success = 'تم إضافة الطبيب بنجاح';



             $this->clearForm();
             $this->current_screen = 1;
             session()->flash("success", " تم إضافة طبيب جديد بنجاح ");
        }
        catch(Exception $e){
            session()->flash("error", "IProblem occured while adding information");
        }
    }


     public function clearForm()
    {
        $this->first_name_ar = '';
        $this->first_name_en = '';
        $this->last_name_ar = '';
        $this->last_name_en = '';
        $this->about_ar = '';
        $this->about_en = '';
        $this->phone = '';
        $this->email = '';
        $this->branch_id = '';
        $this->gender = '';
        $this->p_image = '';
        $this->title_image = '';
        $this->doctor_title_id = '';
        $this->professional_title_id = '';
        $this->specialist_id = '';
        $this->sub_specialist_ids = '';
        $this->salary = '';
        $this->fees = 0;
        $this->discount_fees = 0;
        $this->insurance = '';
        $this->insurance_discount = 0;
        $this->insurance_percentage =0;
    }


    public function render()
    {
        $branches = Branch::all();
        $availableDays = Day::all();
        $doctoTitles = DoctorTitle::all();
        $professionalTitles = ProfessionalTitle::all();
        $specialists = Specialist::all();
        $subSpecialists = SubSpecialist::all();
        $days = Day::get();
        return view('livewire.add-doctor',compact('branches','availableDays','doctoTitles','professionalTitles','specialists','subSpecialists','days'));
    }
}
