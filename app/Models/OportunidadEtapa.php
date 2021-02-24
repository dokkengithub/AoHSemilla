<?php

namespace App\Models;

use App\Traits\ColumnTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OportunidadEtapa extends Model
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
        'oportunidad_header_id' => 'integer',
        'fecha_inicio' => 'datetime',
        'fecha_cierre' => 'datetime',
        'empleado_ventas' => 'integer',
        'etapa' => 'integer',
        'porcentaje' => 'decimal:2',
        'monto_potencial' => 'decimal:2',
        'importe_ponderado' => 'decimal:2',
        'clase_documento' => 'integer',
        'nro_documento' => 'integer',
    ];

    public function oportunidadHeader()
    {
        return $this->belongsTo(\App\Models\OportunidadHeader::class);
    }
}
