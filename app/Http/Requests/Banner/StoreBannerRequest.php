<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'imagen'        => array('required', 'image'),
            'descripcion'   => array('required', 'string','max:255'),
            'link'          => array('required', 'string'),
            'valido_desde'  => array('required', 'date'),
            'valido_hasta'  => array('required', 'date'),
            'eliminado'     => array('nullable', 'integer')
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "required" => "Este campo es obligatorio",
        ];
    }
}
