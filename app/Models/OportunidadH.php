<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OportunidadH extends Model
{
    use HasFactory;

    protected $table = 'Oportunidad_H';
    protected $primaryKey = 'Nro_Oportunidad';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre_Oportunidad',
        'Estado_Documento',
        'Fecha_Inicio',
        'Fecha_Cierre',
        'Porcentaje_Cierre',
        'Tipo_Oportunidad',
        'Codigo_Socio',
        'Codigo_Persona_Contacto',
        'Territorio_Socio_Negocio',
        'Codigo_Empleado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
