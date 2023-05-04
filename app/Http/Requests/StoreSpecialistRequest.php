<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialistRequest extends FormRequest
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
        ];
    }
}
