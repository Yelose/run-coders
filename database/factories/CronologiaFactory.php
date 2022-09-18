<?php

namespace Database\Factories;

use App\Models\Cronologia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CronologiaFactory extends Factory
{
    protected $model = Cronologia::class;

    public function definition()
    {
        return [
			'fecha' => $this->faker->name,
			'titulo' => $this->faker->name,
			'texto' => $this->faker->name,
        ];
    }
}
