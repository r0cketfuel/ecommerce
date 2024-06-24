<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedioEnvio extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    protected $table = 'medios_envios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

    protected $fillable = [
        'medio',
        'costo',
        'estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function activos()
    {
        return(self::where('estado', 1)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function costo($id)
    {
        return(self::find($id)['costo']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
