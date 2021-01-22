<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateQuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => [
                'required',
                'array'
            ],
            'services' => [
                'sometimes',
                'array'
            ],
            'products.*.status' => [
                'integer',
                'required'
            ],
            'products.*.price' => [
                'numeric',
                'nullable',
            ],
            'services.*.price' => [
                'sometimes',
                'numeric',
                'required'
            ],
            'services.*.description' => [
                'string',
                'nullable'
            ],
            'services.*.name' => [
                'sometimes',
                'string',
                'required'
            ],
        ];
    }
}
