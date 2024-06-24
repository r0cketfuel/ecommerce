<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioDomicilio extends Model
{
    use SoftDeletes;

    const CREATED_AT    = 'creado';
    const UPDATED_AT    = 'actualizado';
    const DELETED_AT    = 'eliminado';

    protected $table    = 'usuarios_domicilios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'usuario_id',
        'domicilio',
        'domicilio_nro',
        'domicilio_piso',
        'domicilio_depto',
        'domicilio_aclaraciones',
        'localidad',
        'codigo_postal',
        'principal'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function usuario()
    {
        return($this->belongsTo(Usuario::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
