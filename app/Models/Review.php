<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table    = 'reviews';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'usuario_id',
        'articulo_id',
        'fecha',
        'titulo',
        'texto'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function usuario()
    {
        return($this->belongsTo(Usuario::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->belongsTo(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}