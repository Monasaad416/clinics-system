<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceBookingRequest extends FormRequest
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
                'branch_id' => 'required|exists:branches,id',
                'time' => 'required',
                'date' => 'required',
                'doctor_id' => 'nullable|exists:doctors,id|required_without_all:employee_id',
                'employee_id' => 'nullable|exists:users,id|required_without_all:doctor_id',
                // 'status' => 'required|in:pending,completed,canceled,absent',
                'notes' => 'nullable',
                'service_id' => 'nullable|exists:services,id',
                'payment_method_id' => 'required|exists:payment_methods,id',
                'insurance' => 'nullable|string',
                'insurance_percentage' => 'nullable|numeric',
                'service_price' => 'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'branch_id.required' => trans('validation.required'),
            'time.requird' => trans('validation.required'),
            'date.requird' => trans('validation.required'),
            // 'status.required' => trans('validation.required'),
            'payment_method_id.required' => trans('validation.required'),
            'insurance.string' => trans('validation.string'),
            'insurance_percentage.numeric' => trans('validation.numeric'),
            'service_price.numeric' => trans('validation.numeric'),
            'service_price.required' => trans('validation.required'),
        ];
    
}
}
