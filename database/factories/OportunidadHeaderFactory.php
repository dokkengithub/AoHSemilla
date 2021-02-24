<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadHeader;

class OportunidadHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_oportunidad' => $this->faker->word,
            'estado_documento' => $this->faker->randomNumber(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_cierre' => $this->faker->date(),
            'porcentaje_cierre' => $this->faker->randomFloat(2, 0, 99999999.99),
            'tipo_oportunidad' => $this->faker->randomNumber(),
            'codigo_socio' => $this->faker->randomNumber(),
            'codigo_persona_contacto' => $this->faker->randomNumber(),
            'territorio_socio_negocio' => $this->faker->randomNumber(),
            'codigo_empleado' => $this->faker->randomNumber(),
        ];
    }
}
