<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OportunidadPotencial extends Model
{
    use HasFactory;

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
        'oportunidad_header_id' => 'integer',
        'cierre_planificado_en' => 'integer',
        'cierre_planificado_tipo' => 'integer',
        'fecha_cierre_prevista' => 'date',
        'monto_potencial' => 'decimal:2',
        'monto_ponderado' => 'decimal:2',
        'porc_ganancia_bruta' => 'decimal:2',
        'ganancia_bruta_total' => 'decimal:2',
        'nivel_de_interes' => 'decimal:4',
    ];

    protected $dateFormat = "d-m-Y H:i:s.v";

    public function oportunidadHeader()
    {
        return $this->belongsTo(\App\Models\OportunidadHeader::class);
    }
}
