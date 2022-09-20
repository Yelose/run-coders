<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoticiaFactory extends Factory
{
    protected $model = Noticia::class;

    public function definition()
    {
        return [
            'titular' => $this->faker->name,
            'imagen' => $this->faker->name,
            'piefoto' => $this->faker->name,
            'subtitulo' => $this->faker->name,
            'noticia' => $this->faker->paragraph(3),
            'fecha' => $this->faker->name,
        ];
    }
}
