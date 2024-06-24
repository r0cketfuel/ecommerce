<?php

namespace App\Http\Requests\Articulo;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticuloRequest extends FormRequest
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
            'codigo'            => array('required',"unique:articulos,codigo",'string','max:12'),
            'nombre'            => array('required','string','max:100'),
            'descripcion'       => array('required','string','max:255'),
            'precio'            => array('required','numeric','regex:/^\d+(\.\d{1,2})?$/'),
            'categoria_id'      => array('nullable','integer'),
            'subcategoria_id'   => array('nullable','integer'),
            'estado'            => array('nullable','integer'),
            'visualizaciones'   => array('nullable','integer'),
            'eliminado'         => array('nullable','integer'),
        ];
    }
}
