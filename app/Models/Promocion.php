<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table    = 'promociones';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'articulo_id',
        'valido_desde',
        'valido_hasta',
        'descuento'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
