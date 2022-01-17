<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Editor']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1,$role2]);
        
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.productos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.productos.store'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.productos.update'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.productos.destroy'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'admin.instructivos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.instructivos.store'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.instructivos.update'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.instructivos.destroy'])->syncRoles([$role1,$role2]);
    }
}
