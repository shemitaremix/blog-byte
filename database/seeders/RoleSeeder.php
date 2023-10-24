<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $superAdmin = Role::create(['name'=>'superAdmin']);
        $admin = Role::create(['name'=>'admin']);
        $blogger = Role::create(['name'=>'Blogger']);

        Permission::create(['name'=>'admin'])->syncRoles([$superAdmin]);
        Permission::create(['name'=>'administracion'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'categorias.index'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'categorias.crear'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'categorias.editar'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'categorias.eliminar'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'etiquetas.index'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'etiquetas.crear'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'etiquetas.editar'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'etiquetas.eliminar'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'usuarios.index'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'publicaciones.index'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'publicaciones.crear'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'publicaciones.editar'])->syncRoles([$superAdmin, $admin, $blogger]);
        Permission::create(['name' => 'publicaciones.eliminar'])->syncRoles([$superAdmin, $admin, $blogger]);
    }
}
