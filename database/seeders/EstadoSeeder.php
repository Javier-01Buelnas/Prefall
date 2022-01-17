<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\Localidad;
use App\Models\Municipio;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::factory(8)->create()->each(function(Estado $estado){
            Municipio::factory(8)->create([
                'estado_id' => $estado->id
            ])->each(function(Municipio $municipio){
                Localidad::factory(8)->create([
                    'municipio_id' => $municipio->id
                ]);
            });
        });
    }
}
