<?php

namespace Database\Factories;

use App\Models\pedido;
use App\Models\producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreventaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pedido_id' => Pedido::all()->random()->id,
            'producto_id' => Producto::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1,10),
            'subtotal' => $this->faker->numberBetween(200, 500)
            //'user_id' => User::all()->random()->id,
        ];
    }
}
