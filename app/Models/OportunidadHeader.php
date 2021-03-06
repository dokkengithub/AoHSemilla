<?php

namespace App\Models;

use App\Traits\ColumnTables;
use Database\Factories\OportunidadEtapaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OportunidadHeader extends Model
{
    use HasFactory, ColumnTables;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'estado_documento' => 'integer',
        'fecha_inicio' => 'date:d-m-Y',
        'fecha_cierre' => 'date:d-m-Y',
        'porcentaje_cierre' => 'decimal:2',
        'tipo_oportunidad' => 'integer',
        'codigo_socio' => 'integer',
        'codigo_persona_contacto' => 'integer',
        'territorio_socio_negocio' => 'integer',
        'codigo_empleado' => 'integer',
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i'
    ];


    public function oportunidadas(){
        return $this->hasMany(OportunidadActividad::class);
    }

    public function oportunidadans(){
        return $this->hasMany(OportunidadAnexo::class);
    }

    public function oportunidadcs(){
        return $this->hasMany(OportunidadCompetidor::class);
    }
    public function oportunidades(){
        return $this->hasMany(OportunidadEtapa::class);
    }

    public function oportunidadgs(){
        return $this->hasMany(OportunidadGeneral::class);
    }

    public function oportunidadss(){
        return $this->hasMany(OportunidadSocioNegocio::class);
    }

    public function oportunidadp(){
        return $this->hasOne(OportunidadPotencial::class);
    }


}
