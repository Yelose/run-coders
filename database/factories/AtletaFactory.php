<?php

namespace Database\Factories;

use App\Models\Atleta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AtletaFactory extends Factory
{
    protected $model = Atleta::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'apellidos' => $this->faker->name,
			'licencia' => $this->faker->name,
        ];
    }
}
