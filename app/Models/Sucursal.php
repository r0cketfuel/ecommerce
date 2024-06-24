<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use SoftDeletes;

    const CREATED_AT    = 'creado';
    const UPDATED_AT    = 'actualizado';
    const DELETED_AT    = 'eliminado';

    protected $table    = 'sucursales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'nombre',
        'direccion',
        'entre_calles_1',
        'entre_calles_2',
        'codigo_postal',
        'local',
        'barrio',
        'localidad',
        'provincia',
        'pais',
        'telefono_1',
        'telefono_2',
        'fax',
        'email',
        'geolocalizacion',
        'principal'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
}
