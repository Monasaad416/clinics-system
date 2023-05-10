<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
         
        return [
            'name' => 'required|string|max:255',
        ];
    }

        public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.string' => trans('validation.string'),
            'name.max' => trans('validation.max'),
        ];
    }

}
