<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PersonaContacto;
use App\Models\SocioHeader;
use App\Models\SocioPersonaContacto;

class SocioPersonaContactoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocioPersonaContacto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'socio_header_id' => SocioHeader::factory(),
            'persona_contacto_id' => PersonaContacto::factory(),
            'fecha_creacion' => $this->faker->date(),
            'user_creacion' => $this->faker->randomNumber(),
            'fecha_modificacion' => $this->faker->date(),
            'user_modificacion' => $this->faker->randomNumber(),
        ];
    }
}
