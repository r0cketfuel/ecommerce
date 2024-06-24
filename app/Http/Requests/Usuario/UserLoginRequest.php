<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class UserLoginRequest extends FormRequest
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
            "username" => array("required","min:5","max:16"),
            "password" => array("required","min:8","max:16"),
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        // Verificar si el campo es un nombre de usuario o una dirección de correo
        $username = $this->get("username");

        if ($this->isEmail($username)) {
            return [
                "email" => $username,
                "password" => $this->get("password")
            ];
        }

        return $this->only("username", "password");
    }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ["username" => $param],
            ["username" => "email"]
        )->fails();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "username"      => "Ingrese un nombre de usuario o una dirección de correo válida",
            "username.min"  => "El nombre de usuario debe tener mínimo 5 caracteres",
            "username.max"  => "El nombre de usuario debe tener máximo 16 caracteres",
            "password.min"  => "La contraseña debe tener mínimo 8 caracteres",
            "password.max"  => "La contraseña debe tener máximo 16 caracteres",
        ];
    }
}
