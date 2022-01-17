<?php

namespace Database\Seeders;

use App\Models\categoria;
use App\Models\pedido;
use App\Models\preventa;
use App\Models\producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('categorias');
        Storage::deleteDirectory('subcategorias');
        Storage::deleteDirectory('productos');
        Storage::deleteDirectory('marcas');

        Storage::makeDirectory('categorias');
        Storage::makeDirectory('subcategorias');
        Storage::makeDirectory('productos');
        Storage::makeDirectory('marcas');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(EstadoSeeder::class);
    }
}
