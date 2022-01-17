<?php

namespace Database\Factories;

use App\Models\subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = subcategoria::class;

    public function definition()
    {
        return [
            'imagen' => 'subcategorias/' . $this->faker->image('public/storage/subcategorias', 640, 480, null, false)
        ];
    }
}
