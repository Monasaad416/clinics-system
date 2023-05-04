<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
       public function rules(): array
    {
        $genders = Doctor::getGender();
        return [
            'name_en' => 'nullable|string|max:255',
            'name_ar' => 'required|string|max:255',

            'phone' => 'required|string',
            'gender' =>'required|numeric|in:'.implode(',',$genders),
            'email' => 'nullable|email|max:255|unique:users',
            'about_en' => 'nullable|string',
            'about_ar' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'professional_title_id' => 'nullable|exists:professional_titles,id',
            'doctor_title_id' => 'nullable|exists:doctor_titles,id',
            // 'password' => 'required|string|min:5|max:25|confirmed',
            'image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            'fees' => 'nullable|numeric',
            'discount_fees' => 'nullable|string',
            'insurance' => 'nullable|string|min:3,max:255',
            'insurance_discount' => 'nullable|numeric',
            'insurance_percentage' => 'nullable|numeric',
        ];
    }

        public function messages()
    {
        return [

            'name_ar.required' => trans('validation.required'),
            'name_ar.string' => trans('validation.string'),
            'name_en.string' => trans('validation.string'),

            'name_en.max' => trans('validation.max'),
            'name_ar.max' => trans('validation.max'),

            'phone.required' => trans('validation.required'),
            'phone.string' => trans('validation.string'),
            'gender.required' => trans('validation.required'),
            'gender.numeric' => trans('validation.numeric'),
            'about_ar.required' => trans('validation.required'),
            'about_ar.string' => trans('validation.string'),
            'about_en.required' => trans('validation.required'),
            'about_en.string' => trans('validation.string'),
            'branch_id.required' => trans('validation.required'),
            'professional_title_id.required' => trans('validation.required'),
            'doctor_title_id.required' => trans('validation.required'),
            'fees.numeric' => trans('validation.numeric'),
            'discount_fees.numeric' => trans('validation.numeric'),
            'insurance.string' => trans('validation.string'),
            'insurance_discount.numeric' => trans('validation.numeric'),
            'insurance_percentage.numeric' => trans('validation.numeric'),

        ];
    }
}

