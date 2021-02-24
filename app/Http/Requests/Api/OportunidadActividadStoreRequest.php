<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadActividadStoreRequest extends FormRequest
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
            'fecha_inicio' => ['date'],
            'hora_inicio' => [''],
            'fecha_fin' => ['date'],
            'hora_fin' => [''],
            'asignado_a' => ['integer', 'gt:0'],
            'asignado_por' => ['integer', 'gt:0'],
            'comentario' => ['string'],
        ];
    }
}
