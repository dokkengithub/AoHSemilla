<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocioPersonaContactoUpdateRequest extends FormRequest
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
            'persona_contacto_id' => ['required', 'integer', 'exists:persona_contactos,id'],
            'fecha_creacion' => ['date'],
            'user_creacion' => ['integer', 'gt:0'],
            'fecha_modificacion' => ['date'],
            'user_modificacion' => ['integer', 'gt:0'],
        ];
    }
}
