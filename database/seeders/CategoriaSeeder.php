<?php

namespace Database\Seeders;

use App\Models\categoria;
use App\Models\marca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Seguridad Industrial',
                'slug' => Str::slug('Seguridad Industrial'),
                'icono' => '<i class="fas fa-hard-hat"></i>'
            ],
            [
                'nombre' => 'Herramientas',
                'slug' => Str::slug('Herramientas'),
                'icono' => '<i class="fas fa-hammer"></i>'
            ],
            [
                'nombre' => 'Ferreteria',
                'slug' => Str::slug('Ferreteria'),
                'icono' => '<i class="fas fa-tape"></i>'
            ],
            [
                'nombre' => 'Accesorios y Refacciones',
                'slug' => Str::slug('Accesorios y Refacciones'),
                'icono' => '<i class="fas fa-cogs"></i>'
            ],
            [
                'nombre' => 'Plomeria',
                'slug' => Str::slug('Plomeria'),
                'icono' => '<i class="fas fa-faucet"></i>'
            ],
            [
                'nombre' => 'Material Electrico',
                'slug' => Str::slug('Material Electrico'),
                'icono' => '<i class="fas fa-bolt"></i>'
            ]
        ];

        foreach ($categorias as $categoria) {
            $categoria = categoria::factory(1)->create($categoria)->first();

            $marcas = marca::factory(4)->create();
            foreach ($marcas as $marca) {
                $marca->categorias()->attach($categoria->id);
            }
        }
    }
}
