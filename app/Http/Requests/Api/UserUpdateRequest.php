<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\PseudoTypes\True_;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . request('id')
            //'email' => [ 'required' , 'string', 'email', 'max:255', Rule::unique('users')->ignore(Request::get('id')),]
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
            'name.required' => 'El nombre de usuario es requerido.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre de usuario debe contener 255 caracteres como máximo.',

            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya ha sido registrado',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El email no tiene un formato adecuado.',
            'email.max' => 'El email debe contener 255 caracteres como máximo.',

            'password.required' => 'El password es requerido',
            'password.string' => 'El password debe ser una cadena de texto.',
            'password.min' => 'El password debe contener como mínimo 6 caracteres.',
            'password.confirmed' => 'El password no se ha confirmado.',
        ];
    }
}
