<?php

namespace Database\Seeders;

use App\Models\image;
use App\Models\producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        producto::factory(150)->create()->each(function(producto $producto){
            image::factory(3)->create([
                'imageable_id' => $producto->id,
                'imageable_type' => producto::class
            ]);
        });
    }
}
