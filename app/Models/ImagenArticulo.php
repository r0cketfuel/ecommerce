<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenArticulo extends Model
{
    protected $table    = 'imagenes_articulos';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'ruta',
        'descripcion'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->belongsTo(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
