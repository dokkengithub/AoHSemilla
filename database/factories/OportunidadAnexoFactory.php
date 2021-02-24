<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OportunidadAnexo;
use App\Models\OportunidadHeader;

class OportunidadAnexoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OportunidadAnexo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oportunidad_header_id' => OportunidadHeader::factory(),
            'tipo_anexo' => $this->faker->randomNumber(),
            'descripcion' => $this->faker->text,
            'path' => $this->faker->word,
        ];
    }
}
