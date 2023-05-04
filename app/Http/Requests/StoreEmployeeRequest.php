<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string',
            'password' => 'required|string|min:5|max:25|confirmed',
            'image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'nullable|numeric|min:0',
            'roles_name' => 'required'
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
            'password.required' => trans('validation.required'),
            'password.string' => trans('validation.string'),
            'password.min' => trans('validation.min'),
            'password.max' => trans('validation.max'),
            'password.confirmed' => trans('validation.confirmed'),
            'image.image' => trans('validation.image'),
            'imagae.max' => trans('validation.max'),
            'imagae.mimes' => trans('validation.mimes'),
            'department_id.requird' => trans('validation.requird'),
            'department_id.exists' => trans('validation.exists'),

            'salary.numeric' => trans('validation.numeric'),
            'roles_name.required' => trans('validation.required'),
        ];
    }
}
