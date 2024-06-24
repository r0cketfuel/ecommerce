<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table    = 'cupones';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'codigo',
        'usuario_id',
        'valido_desde',
        'valido_hasta',
        'estado',
        'tipo_descuento',
        'descuento'
    ];

}