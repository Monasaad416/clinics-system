<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'lattitude' =>'required|numeric',
            'longitude' =>'required|numeric',
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
            'address_en.required' => trans('validation.required'),
            'address_en.string' => trans('validation.string'),
            'address_ar.required' => trans('validation.required'),
            'address_ar.string' => trans('validation.string'),
            'description_en.required' => trans('validation.required'),
            'description_en.string' => trans('validation.string'),
            'description_ar.required' => trans('validation.required'),
            'description_ar.string' => trans('validation.string'),
            'lattitude.required' => trans('validation.required'),
            'lattitude.numeric' => trans('validation.numeric'),
            'longitude.required' => trans('validation.required'),
            'longitude.numeric' => trans('validation.numeric'),
        ];
    }
}
