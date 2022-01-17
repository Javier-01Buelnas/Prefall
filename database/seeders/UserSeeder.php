<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Abel Ramos Valezzi',
            'company' => 'Precolado y Fabricacion S.A. de C.V.',
            'address' => 'San Jose del RIncon, Mexico',
            'email' => 'abelramos@precolado.com.mx',
            'email_verified_at' => now(),
            'phone' => '5531865857',
            'password' => bcrypt('12345678'), // password
            
        ])->assignRole('admin');
        User::factory(99)->create();
    }
}
