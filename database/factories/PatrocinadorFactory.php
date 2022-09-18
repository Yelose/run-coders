<?php

namespace Database\Factories;

use App\Models\Patrocinador;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PatrocinadorFactory extends Factory
{
    protected $model = Patrocinador::class;

    public function definition()
    {
        return [
			'logo' => $this->faker->name,
			'enlace' => $this->faker->name,
        ];
    }
}
