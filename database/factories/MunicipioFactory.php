<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MunicipioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'costo' => $this->faker->randomElement([5, 10, 15])
        ];
    }
}
