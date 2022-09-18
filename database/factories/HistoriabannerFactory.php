<?php

namespace Database\Factories;

use App\Models\Historiabanner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HistoriabannerFactory extends Factory
{
    protected $model = Historiabanner::class;

    public function definition()
    {
        return [
			'imagen' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'origen' => $this->faker->name,
        ];
    }
}
