<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadHeader;
use App\Models\OportunidadSocioNegocio;
use App\Models\SocioHeader;

class OportunidadSocioNegocioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadSocioNegocio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'socio_header_id' => SocioHeader::factory(),
            'codigo_socio' => $this->faker->randomNumber(),
            'relacion' => $this->faker->randomNumber(),
            'comentario' => $this->faker->word,
        ];
    }
}
