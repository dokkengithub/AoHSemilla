<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocioHeaderUpdateRequest extends FormRequest
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
            'nombre' => ['string', 'max:200'],
            'tipo_de_socio' => ['integer', 'gt:0'],
            'codigo_grupo' => ['integer', 'gt:0'],
            'codigo_moneda' => ['integer', 'gt:0'],
            'ruc' => ['string', 'max:10'],
        ];
    }
}
