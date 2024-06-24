<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => array("required","email","unique:newsletters,email","min:10","max:50"),
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
            "email.min"     => "El correo ingresado debe tener mínimo 10 caracteres",
            "email.max"     => "El correo ingresado debe tener máximo 50 caracteres",
            "email.unique"  => "El correo ingresado ya existe",
        ];
    }
}
