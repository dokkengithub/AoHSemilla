<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El email no tiene un formato adecuado.',
            'email.max' => 'El email debe contener 255 caracteres como máximo.',

            'password.required' => 'El password es requerido',
            'password.string' => 'El password debe ser una cadena de texto.',
            'password.min' => 'El password debe contener como mínimo 6 caracteres.'
        ];
    }
}
