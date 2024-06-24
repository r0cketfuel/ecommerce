<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

//Mutador para campos
use Illuminate\Database\Eloquent\Casts\Attribute;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    const CREATED_AT        = 'creado';
    const UPDATED_AT        = 'actualizado';
    const DELETED_AT        = 'eliminado';
    const EMAIL_VERIFIED_AT = 'alta';

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
        'tipo_documento_id',
        'documento_nro',
        'cuit',
        'cuil',
        'fecha_nacimiento',
        'genero_id',
        'telefono_fijo',
        'telefono_celular',
        'telefono_alt',
        'email',
        'token_verificacion_email',
        'estado',
        'alta'
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
    public function tipoDocumento()
    {
        return($this->belongsTo(TipoDocumento::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function genero()
    {
        return($this->belongsTo(Genero::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function domicilios()
    {
        return($this->hasMany(UsuarioDomicilio::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function review()
    {
        return($this->hasMany(Review::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    protected function username(): Attribute
    {
        return new Attribute(
            get: function ($value) { return strtolower($value); },
            set: function ($value) { return strtolower($value); }
        );
    }

    protected function apellidos(): Attribute
    {
        return new Attribute(
            get: function ($value) { return ucwords(strtolower($value)); },
            set: function ($value) { return ucwords(strtolower($value)); }
        );
    }

    protected function nombres(): Attribute
    {
        return new Attribute(
            get: function ($value) { return ucwords(strtolower($value)); },
            set: function ($value) { return ucwords(strtolower($value)); }
        );
    }

    protected function email(): Attribute
    {
        return new Attribute(
            get: function ($value) { return strtolower($value); },
            set: function ($value) { return strtolower($value); }
        );
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function validaCuit($cuit)
    {
        if(strlen($cuit) == 11) 
        {
            $rv = false;
            $resultado = 0;
            
            $codes = '6789456789';
            $verificador = intVal($cuit[strlen($cuit)-1]);
            
            $x = 0;
            
            while ($x < 10)
            {
                $digitoValidador = intVal(substr($codes, $x, 1));
                $digito = intVal(substr($cuit, $x, 1));
                $digitoValidacion = $digitoValidador * $digito;
                $resultado += $digitoValidacion;
                $x++;
            }
            $resultado = intVal($resultado) % 11;
            $rv = $resultado == $verificador;
            return $rv;

        }
        
        return(false);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
