<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonaContactoUpdateRequest extends FormRequest
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
            'titulo' => ['integer', 'gt:0'],
            'primer_nombre' => ['string', 'max:200'],
            'segundo_nombre' => ['string', 'max:200'],
            'apellido_paterno' => ['string', 'max:200'],
            'apellido_materno' => ['string', 'max:200'],
            'direccion' => ['string', 'max:200'],
            'telefono_1' => ['string', 'max:200'],
            'telefono_2' => ['string', 'max:200'],
            'movil' => ['string', 'max:20'],
            'email' => ['email', 'max:200'],
            'ciudad_nacimiento' => ['integer', 'gt:0'],
        ];
    }
}
