<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'url' => [
                'required',
                'url'
            ],
            'title' => [
                'required',
                'min:6'
            ],
            'rating' => [
                'required',
                'numeric'
            ],
            'asin' => [
                'required'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'total_reviews' => [
                'required',
                'integer'
            ],
            'images' => [
                'required',
                'array'
            ],
            'item_available' => [
                'required',
                'boolean'
            ],
            'options' => [
                'required'
            ],
            'options.quantity' => [
                'numeric'
            ]
        ];
    }
}
