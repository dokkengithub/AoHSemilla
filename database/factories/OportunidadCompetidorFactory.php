<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadCompetidor;
use App\Models\OportunidadHeader;

class OportunidadCompetidorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadCompetidor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'competidor' => $this->faker->randomNumber(),
            'nivelamenaza_id' => $this->faker->randomNumber(),
            'comentario' => $this->faker->text,
            'ganado' => $this->faker->boolean,
        ];
    }
}
