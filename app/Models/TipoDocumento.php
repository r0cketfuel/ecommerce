<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table    = 'tipos_documentos';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'tipo',
        'descripcion'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function search(string $search)
    {
        return(self::Where('tipo', 'LIKE', '%' . $search . '%')->first()->toArray());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}