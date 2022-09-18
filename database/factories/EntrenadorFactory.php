<?php

namespace Database\Factories;

use App\Models\Entrenador;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EntrenadorFactory extends Factory
{
    protected $model = Entrenador::class;

    public function definition()
    {
        return [
			'imagen' => $this->faker->name,
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
