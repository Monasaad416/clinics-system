<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'from_date' => 'required|date',
            'to_date' =>'required|date',
            'price' => 'required|numeric',
            'discount_percentage' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id'

        ];
    }

        public function messages()
    {
        return [
            'title_ar.required' => trans('validation.required'),
            'title_ar.string' => trans('validation.string'),
            'title_ar.max' => trans('validation.max'),
            'title_en.required' => trans('validation.required'),
            'title_en.string' => trans('validation.string'),
            'title_en.max' => trans('validation.max'),
            'description_ar.required' => trans('validation.required'),
            'description_ar.string' => trans('validation.string'),
            'description_en.required' => trans('validation.required'),
            'description_en.string' => trans('validation.string'),
            'from_date.required' => trans('validation.required'),
            'from_date.date' => trans('validation.date'),
            'to_date.required' => trans('validation.required'),
            'to_date.date' => trans('validation.date'),
            'price.required' => trans('validation.required'),
            'price.numeric' => trans('validation.numeric'),
            'discount_price.required' => trans('validation.required'),
            'discount_price.numeric' => trans('validation.numeric'),
            'discountPercentage.required' => trans('validation.required'),
            'discountPercentage.numeric' => trans('validation.numeric'),
             'branch_id.required' => trans('validation.required'),

        ];
    }
}
