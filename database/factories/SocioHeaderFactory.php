<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SocioHeader;

class SocioHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocioHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'tipo_de_socio' => $this->faker->randomNumber(),
            'codigo_grupo' => $this->faker->randomNumber(),
            'codigo_moneda' => $this->faker->randomNumber(),
            'ruc' => $this->faker->randomLetter,
        ];
    }
}
