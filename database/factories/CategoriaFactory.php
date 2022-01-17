<?php

namespace Database\Factories;

use App\Models\categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = categoria::class;
    public function definition()
    {
        return [
            'imagen' => 'categorias/' . $this->faker->image('public/storage/categorias', 640, 480, null, false)
        ];
    }
}
