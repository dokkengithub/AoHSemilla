<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocioDireccionUpdateRequest extends FormRequest
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
            'socio_header_id' => ['required', 'integer', 'exists:socio_headers,id'],
            'direccion_id' => ['required', 'integer', 'gt:0'],
            'tipo_direccion' => ['integer', 'gt:0'],
            'direccion_completa' => ['string', 'max:200'],
            'pais' => ['integer'],
            'departamento' => ['integer'],
            'provincia' => ['integer'],
            'distrito' => ['integer'],
        ];
    }
}
