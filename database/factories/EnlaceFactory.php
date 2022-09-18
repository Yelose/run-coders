<?php

namespace Database\Factories;

use App\Models\Enlace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnlaceFactory extends Factory
{
    protected $model = Enlace::class;

    public function definition()
    {
        return [
			'imagen' => $this->faker->name,
			'enlace' => $this->faker->name,
        ];
    }
}
