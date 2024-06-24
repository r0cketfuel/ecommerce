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
    protected static function booted()
    {
        static::retrieved(function ($imagen) {
            $imagen->miniatura  = asset(config('constants.product_images') . '/' . $imagen->articulo_id . '/thumbs/'    . $imagen->ruta);
            $imagen->ruta       = asset(config('constants.product_images') . '/' . $imagen->articulo_id . '/'           . $imagen->ruta);
        });
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->belongsTo(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
