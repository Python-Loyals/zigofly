<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
                'array',
                'min:1',
            ],
            'products.*.name' => 'required',
            'products.*.link' => 'required|url',
            'products.*.quantity' => 'required|integer',
            'products.*.options' => 'nullable',
            'attachments.*' => 'nullable|mimes:docx,doc,pdf,jpg,jpeg,bmp,png,gif,svg|max:5000',
            'buy_ship' => 'required_without:ship',
            'ship' => 'required_without:buy_ship'
        ];
    }

    public function messages()
    {
        return [
            'products.*.name.required' => 'Product name is required',
            'products.*.link.required' => 'Product Url is required',
            'products.*.link.url' => 'Product Url is invalid',
            'products.*.quantity.required' => 'Product quantity is required',
            'products.*.quantity.integer' => 'Product quantity must be an integer',
        ];
    }
}
