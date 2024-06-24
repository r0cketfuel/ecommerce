<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedioPago extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    protected $table = "medios_pagos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

    protected $fillable = [
        "medio",
        "estado"
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function activos()
    {
        return(self::where("estado", 1)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
