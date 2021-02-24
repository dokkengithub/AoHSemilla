<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadPotencialStoreRequest extends FormRequest
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
            'cierre_planificado_en' => ['integer', 'gt:0'],
            'cierre_planificado_tipo' => ['integer', 'gt:0'],
            'fecha_cierre_prevista' => ['date'],
            'monto_potencial' => ['required', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'monto_ponderado' => ['required', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'porc_ganancia_bruta' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'ganancia_bruta_total' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'nivel_de_interes' => ['required', 'numeric', 'between:-99999999999999.9999,99999999999999.9999'],
        ];
    }
}
