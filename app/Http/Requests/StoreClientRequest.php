<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $methods = Client::getMethod();
         
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients',
            'phone' => 'required|string|unique:clients',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
            'how_know_us' =>'nullable|numeric|in:'.implode(',',$methods),
            'file_no' => 'required|string',
        ];
    }

        public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.string' => trans('validation.string'),
            'name.max' => trans('validation.max'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'phone.required' => trans('validation.required'),
            'phone.string' => trans('validation.string'),
            'date_of_birth.required' => trans('validation.required'),
            'date_of_birth.date' => trans('validation.date'),
            'how_know_us.nullable' => trans('validation.required'),
            'how_know_us.numeric' => trans('validation.numeric'),
            'file_no' => trans('validation.required'),
            'string' => trans('validation.string'),
        ];
    }
}
