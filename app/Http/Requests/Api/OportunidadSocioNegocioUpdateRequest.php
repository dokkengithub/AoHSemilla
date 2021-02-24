<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadSocioNegocioUpdateRequest extends FormRequest
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
            'socio_header_id' => ['required', 'integer', 'exists:socio_headers,id'],
            'codigo_socio' => ['required', 'integer', 'gt:0'],
            'relacion' => ['integer', 'gt:0'],
            'comentario' => ['string', 'max:200'],
        ];
    }
}
