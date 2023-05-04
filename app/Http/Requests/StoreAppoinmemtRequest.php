<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppoinmemtRequest extends FormRequest
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
       return [
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string',
                'branch_id' => 'required|exists:branches,id',
                'day_id' => 'required',
                'doctor_id' => 'required|exists:doctors,id',
                ];

    }

            public function messages()
    {
        return [
            //'name.required' => trans('validation.name_required'),
            'name.string' => trans('validation.string'),
            'name.max' => trans('validation.name_max'),
            // 'email.required' => trans('validation.email_required'),
            'email.email' => trans('validation.email_email'),
            'email.max' => trans('validation.email_max'),
            // 'email.unique' => trans('validation.email_unique'),
            'date_of_birth.required' => trans('validation.date_of_birth_required'),
            'date_of_birth.date' => trans('validation.date_of_birth_date'),
    
            'phone.required' => trans('validation.phonerequired'),
            'phone.string' => trans('validation.phone_string'),
            // 'phone.unique' => trans('validation.phone_fa-ul'),
            'branch_id.required' => trans('validation.branch_required'),
            'branch_id.exist' =>  trans('validation.branch_exists'),
            'day_id.required' => trans('validation.day_required'),
            'day_id.exist' =>  trans('validation.day_exists'),
            'doctor_id.exist' =>  trans('validation.doctor_exists'),
            'doctor_id.required' => trans('validation.doctor_required'),
        ];
    }



}
