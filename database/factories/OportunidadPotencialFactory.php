<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadHeader;
use App\Models\OportunidadPotencial;

class OportunidadPotencialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadPotencial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'cierre_planificado_en' => $this->faker->randomNumber(),
            'cierre_planificado_tipo' => $this->faker->randomNumber(),
            'fecha_cierre_prevista' => $this->faker->date(),
            'monto_potencial' => $this->faker->randomFloat(2, 0, 9999999999999999.99),
            'monto_ponderado' => $this->faker->randomFloat(2, 0, 9999999999999999.99),
            'porc_ganancia_bruta' => $this->faker->randomFloat(2, 0, 99999999.99),
            'ganancia_bruta_total' => $this->faker->randomFloat(2, 0, 99999999.99),
            'nivel_de_interes' => $this->faker->randomFloat(4, 0, 99999999999999.9999),
        ];
    }
}
