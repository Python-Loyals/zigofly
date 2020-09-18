<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'email'   => [
                'required',
                'unique:users,email,' . request()->user()->id,
            ],
            'phone'   => [
                'required',
                'unique:users,phone,' . request()->user()->id,
                'regex:/^(0|\+?254)(\d){9}$/',
            ],
            'county'   => [
                'required',
                'integer',
                'exists:counties,id'
            ],
            'age'      => [
                'required',
                'integer',
                'exists:ages,id'
            ],

        ];
    }
}
