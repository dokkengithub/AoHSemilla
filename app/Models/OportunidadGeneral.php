<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OportunidadGeneral extends Model
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
    ];

    protected $dateFormat = "d-m-Y H:i:s.v";

    public function oportunidadHeader()
    {
        return $this->belongsTo(\App\Models\OportunidadHeader::class);
    }
}
