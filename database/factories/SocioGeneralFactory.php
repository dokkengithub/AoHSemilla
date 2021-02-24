<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SocioGeneral;
use App\Models\SocioHeader;

class SocioGeneralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocioGeneral::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'socio_header_id' => SocioHeader::factory(),
            'alias' => $this->faker->word,
            'telefono_1' => $this->faker->word,
            'telefono_2' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'sitio_web' => $this->faker->word,
            'comentario' => $this->faker->text,
        ];
    }
}
