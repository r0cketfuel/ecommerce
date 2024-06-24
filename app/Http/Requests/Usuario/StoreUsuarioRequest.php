<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            "username"          => ["required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"],
            "password"          => ["required","min:8","max:16"],
            "password_repeat"   => ["same:password"],
            "apellidos"         => ["required","alpha","min:4","max:50"],
            "nombres"           => ["required","alpha","min:4","max:50"],
            "tipo_documento_id" => ["required","integer","min:1", "exists:tipos_documentos,id"],
            "documento_nro"     => ["required","integer","between:1000000,99999999",'regex:/^\d{7,8}$/'],
            "genero_id"         => ["integer","min:1","exists:generos,id"],
            "cuil"              => ["nullable","numeric","digits:11"],
            "cuit"              => ["nullable","numeric","digits:11"],
            "fecha_nacimiento"  => ["required","date","before:today"],
            "telefono_fijo"     => ["required","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
            "telefono_celular"  => ["required","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
            "telefono_alt"      => ["nullable","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
            "email"             => ["required",'email:rfc,dns',"min:12","max:50"],
        ];
    }
}
