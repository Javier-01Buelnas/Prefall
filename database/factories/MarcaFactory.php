<?php

namespace Database\Factories;

use App\Models\marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarcaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = marca::class;
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'imagen' => 'marcas/'.$this->faker->image('public/storage/marcas',640,640,null,false)
        ];
    }
}
