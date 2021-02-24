<?php

namespace App\Models;

use App\Traits\ColumnTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocioDireccion extends Model
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
        'socio_header_id' => 'integer',
        'direccion_id' => 'integer',
        'tipo_direccion' => 'integer',
    ];


    public function socioHeader()
    {
        return $this->belongsTo(\App\Models\SocioHeader::class);
    }
}
