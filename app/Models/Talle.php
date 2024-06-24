<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table    = 'talles';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'talle'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributos()
    {
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}