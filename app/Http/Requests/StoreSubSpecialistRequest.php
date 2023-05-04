<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubSpecialistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'specialist_id' => 'required|exists:specialists,id'
        ];
    }

        public function messages()
    {
        return [
            'name_en.required' => trans('validation.required'),
            'name_en.string' => trans('validation.string'),
            'name_en.max' => trans('validation.max'),
            'name_ar.required' => trans('validation.required'),
            'name_ar.string' => trans('validation.string'),
            'name_ar.max' => trans('validation.max'),
            'specialist_id.required' => trans('validation.required'),
            'specialist_id.exists' => trans('validation.exists'),
        ];
    }
}
