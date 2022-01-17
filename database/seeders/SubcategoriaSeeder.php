<?php

namespace Database\Seeders;

use App\Models\subcategoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategorias = [
            //Seguridad Industrial
            [
                'categoria_id' => 1,
                'nombre' => 'Proteccion Personal',
                'slug' => Str::slug('Proteccion Personal')
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Seguridad Vial',
                'slug' => Str::slug('Seguridad Vial')
            ],
            //Herramientas
            [
                'categoria_id' => 2,
                'nombre' => 'Herramientas Manuales',
                'slug' => Str::slug('Herramientas Manuales')
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Maquinas Electricas',
                'slug' => Str::slug('Maquinas Electricas')
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Herramientas de Medicion',
                'slug' => Str::slug('Herramientas de Medicion')
            ],
            //Ferreteria
            [
                'categoria_id' => 3,
                'nombre' => 'Fijacion y Sujecion',
                'slug' => Str::slug('Fijacion y Sujecion')
            ],
            [
                'categoria_id' => 3,
                'nombre' => 'Cintas',
                'slug' => Str::slug('Cintas')
            ],
            [
                'categoria_id' => 3,
                'nombre' => 'Mallas y Alambre',
                'slug' => Str::slug('Mallas y alambre')
            ],
            //Accesorios y Refacciones
            [
                'categoria_id' => 4,
                'nombre' => 'Para Herramientas de Construccion',
                'slug' => Str::slug('Para Herramientas de Construccion ')
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Para Seguridad Industrial',
                'slug' => Str::slug('Para Seguridad Industrial')
            ],
            //Plomeria
            [
                'categoria_id' => 5,
                'nombre' => 'Tuberias y Conexiones',
                'slug' => Str::slug('Tuberias y Conexiones')
            ],
            [
                'categoria_id' => 5,
                'nombre' => 'Valvulas',
                'slug' => Str::slug('Valvulas')
            ],
            //Material Electrico
            [
                'categoria_id' => 6,
                'nombre' => 'Extensiones y Multicontactos',
                'slug' => Str::slug('Fijacion y Sujecion')
            ],
            [
                'categoria_id' => 6,
                'nombre' => 'Interruptores',
                'slug' => Str::slug('Interruptores')
            ]
        ];
        foreach ($subcategorias as $subcategoria) {
            subcategoria::create($subcategoria);
        }
    }
}
