<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PersonaContacto;

class PersonaContactoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonaContacto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->randomNumber(),
            'primer_nombre' => $this->faker->word,
            'segundo_nombre' => $this->faker->word,
            'apellido_paterno' => $this->faker->word,
            'apellido_materno' => $this->faker->word,
            'direccion' => $this->faker->word,
            'telefono_1' => $this->faker->word,
            'telefono_2' => $this->faker->word,
            'movil' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'ciudad_nacimiento' => $this->faker->randomNumber(),
        ];
    }
}
