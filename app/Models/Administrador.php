<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Authenticatable
{
    use SoftDeletes;

    const CREATED_AT    = 'creado';
    const UPDATED_AT    = 'actualizado';
    const DELETED_AT    = 'eliminado';

    protected $table    = 'administradores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'username',
        'password',
        'apellidos',
        'nombres',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_repeat',
        'remember_token',
        'creado',
        'actualizado',
        'eliminado'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}    
