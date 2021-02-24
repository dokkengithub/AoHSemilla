<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadActividad;
use App\Models\OportunidadHeader;

class OportunidadActividadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadActividad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'fecha_inicio' => $this->faker->date(),
            'hora_inicio' => $this->faker->time(),
            'fecha_fin' => $this->faker->date(),
            'hora_fin' => $this->faker->time(),
            'asignado_a' => $this->faker->randomNumber(),
            'asignado_por' => $this->faker->randomNumber(),
            'comentario' => $this->faker->text,
        ];
    }
}
