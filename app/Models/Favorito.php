<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Favorito extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'usuario_id',
        'articulo_id'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
}