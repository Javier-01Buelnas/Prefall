<?php

namespace Database\Factories;

use App\Models\producto;
use App\Models\subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = producto::class;

    public function definition()
    {
        
        $name = $this->faker->unique()->sentence(2);
        $subcategoria = subcategoria::all()->random();
        $categoria = $subcategoria->categoria;

        $marca = $categoria->marcas->random();

        return [
            'clave' => $this->faker->text(5),
            'nombre' => $name,
            'slug' => Str::slug($name),
            'descripcion' => $this->faker->text(),
            'precioCompra' => $this->faker->numberBetween(50, 600),
            'precioVenta' => $this->faker->numberBetween(50, 600),
            'estado' => 2,
            'stock' => $this->faker->randomElement([10,25,50,100,40]),
            'subcategoria_id' => $subcategoria->id,
            'marca_id' => $marca->id


        ];
    }
}
