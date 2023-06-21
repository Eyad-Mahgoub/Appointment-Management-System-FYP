<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reg_first_name'    => ['required'],
            'reg_last_name'     => ['required'],
            'reg_age'           => ['required'],
            'reg_address'       => ['required'],
            'reg_email'         => ['required', 'email', 'unique:users,email'],
            'reg_password'      => ['required', 'min:8'],
        ];
    }
}
