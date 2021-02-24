<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadEtapaUpdateRequest extends FormRequest
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
            'oportunidad_header_id' => ['required', 'integer', 'exists:oportunidad_headers,id'],
            'fecha_inicio' => [''],
            'fecha_cierre' => [''],
            'empleado_ventas' => ['integer', 'gt:0'],
            'etapa' => ['integer', 'gt:0'],
            'porcentaje' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'monto_potencial' => ['required', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'importe_ponderado' => ['required', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'clase_documento' => ['integer', 'gt:0'],
            'nro_documento' => ['integer', 'gt:0'],
        ];
    }
}
