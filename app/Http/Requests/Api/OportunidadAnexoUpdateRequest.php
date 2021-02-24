<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OportunidadAnexoUpdateRequest extends FormRequest
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
            'tipo_anexo' => ['integer', 'gt:0'],
            'descripcion' => ['string'],
            'path' => ['string', 'max:500'],
        ];
    }
}
