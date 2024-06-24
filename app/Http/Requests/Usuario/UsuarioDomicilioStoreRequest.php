<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioDomicilioStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "domicilio"         => array("required","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "domicilio_nro"     => array("required","numeric","max:99999"),
            "domicilio_piso"    => array("nullable","max:2","regex:#^[a-zA-Z0-9]*$#"),
            "domicilio_depto"   => array("nullable","max:2","regex:#^[a-zA-Z0-9]*$#"),
            "localidad"         => array("required","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "codigo_postal"     => array("required","max:10","regex:#^[a-zA-Z0-9]*$#")
        ];
    }
}
