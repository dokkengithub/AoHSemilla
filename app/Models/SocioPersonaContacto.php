<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocioPersonaContacto extends Model
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
        'socio_header_id' => 'integer',
        'persona_contacto_id' => 'integer',
        'fecha_creacion' => 'date',
        'user_creacion' => 'integer',
        'fecha_modificacion' => 'date',
        'user_modificacion' => 'integer',
    ];


    public function socioHeader()
    {
        return $this->belongsTo(\App\Models\SocioHeader::class);
    }

    public function personaContacto()
    {
        return $this->belongsTo(\App\Models\PersonaContacto::class);
    }
}
