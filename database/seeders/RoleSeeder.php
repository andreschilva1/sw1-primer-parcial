<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2= Role::create(['name' => 'Organizador']);
        $role3 = Role::create(['name' => 'Cliente']);
        $role4 = Role::create(['name' => 'Fotografo']);
        
        
        
        $permission = Permission::create(['name' => 'Gestionar Perfil'])->syncRoles([$role1,$role2,$role3,$role4]);
        $permission = Permission::create(['name' => 'Gestionar Usuarios'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Crear Eventos'])->syncRoles([$role2]);
        $permission = Permission::create(['name' => 'Editar Eventos'])->syncRoles([$role2]);
        $permission = Permission::create(['name' => 'Eliminar Eventos'])->syncRoles([$role2]);
        
        $permission = Permission::create(['name' => 'Enviar Solicitud'])->syncRoles([$role3,$role4]);
        $permission = Permission::create(['name' => 'Añadir Fotos'])->syncRoles([$role4]);
        $permission = Permission::create(['name' => 'Fotos Cliente'])->syncRoles([$role3]);

        $permission = Permission::create(['name' => 'Lista de invitados'])->syncRoles([$role2]);
        $permission = Permission::create(['name' => 'solicitudes'])->syncRoles([$role2]);
        
        
    }
}
