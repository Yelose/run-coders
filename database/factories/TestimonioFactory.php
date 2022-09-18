<?php

namespace Database\Factories;

use App\Models\Testimonio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestimonioFactory extends Factory
{
    protected $model = Testimonio::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'testimonio' => $this->faker->name,
        ];
    }
}
