<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marquesina extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'mensaje',
        'valido_desde',
        'valido_hasta'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        return(self::where('valido_desde', '<=', now())->where('valido_hasta', '>=', now())->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
