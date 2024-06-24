<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoComercio extends Model
{
    protected $table    = 'info_comercio';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'nombre',
        'slogan',
        'descripcion',
        'cuit',
        'facebook',
        'instagram',
        'tiktok',
        'whatsapp'
    ];

}