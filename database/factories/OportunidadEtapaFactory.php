<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadEtapa;
use App\Models\OportunidadHeader;

class OportunidadEtapaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadEtapa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'fecha_inicio' => $this->faker->dateTime(),
            'fecha_cierre' => $this->faker->dateTime(),
            'empleado_ventas' => $this->faker->randomNumber(),
            'etapa' => $this->faker->randomNumber(),
            'porcentaje' => $this->faker->randomFloat(2, 0, 99999999.99),
            'monto_potencial' => $this->faker->randomFloat(2, 0, 9999999999999999.99),
            'importe_ponderado' => $this->faker->randomFloat(2, 0, 9999999999999999.99),
            'clase_documento' => $this->faker->randomNumber(),
            'nro_documento' => $this->faker->randomNumber(),
        ];
    }
}
