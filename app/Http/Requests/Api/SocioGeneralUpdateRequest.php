<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocioGeneralUpdateRequest extends FormRequest
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
            'alias' => ['string', 'max:200'],
            'telefono_1' => ['string', 'max:200'],
            'telefono_2' => ['string', 'max:200'],
            'email' => ['email', 'max:200'],
            'sitio_web' => ['string', 'max:200'],
            'comentario' => ['string'],
        ];
    }
}
