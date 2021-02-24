<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SocioDireccion;
use App\Models\SocioHeader;

class SocioDireccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocioDireccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'socio_header_id' => SocioHeader::factory(),
            'direccion_id' => $this->faker->randomNumber(),
            'tipo_direccion' => $this->faker->randomNumber(),
            'direccion_completa' => $this->faker->word,
            'pais' => $this->faker->numberBetween(-10000, 10000),
            'departamento' => $this->faker->numberBetween(-10000, 10000),
            'provincia' => $this->faker->numberBetween(-10000, 10000),
            'distrito' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
