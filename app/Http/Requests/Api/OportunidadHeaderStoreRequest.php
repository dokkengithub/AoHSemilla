<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadHeaderStoreRequest extends FormRequest
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
            'nombre_oportunidad' => ['string', 'max:200'],
            'estado_documento' => ['integer', 'gt:0'],
            'fecha_inicio' => ['date'],
            'fecha_cierre' => ['date'],
            'porcentaje_cierre' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'tipo_oportunidad' => ['integer', 'gt:0'],
            'codigo_socio' => ['integer', 'gt:0'],
            'codigo_persona_contacto' => ['integer', 'gt:0'],
            'territorio_socio_negocio' => ['integer', 'gt:0'],
            'codigo_empleado' => ['integer', 'gt:0'],
        ];
    }
}
