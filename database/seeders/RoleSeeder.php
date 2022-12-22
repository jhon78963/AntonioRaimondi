<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'docente']);
        $role3 = Role::create(['name' => 'alumno']);
        $role4 = Role::create(['name' => 'secretaria']);
        $role5 = Role::create(['name' => 'invitado']);

        Permission::create(['name' => 'bienvenido.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'roles.index'])->syncRoles([$role1, $role5]);
        Permission::create(['name' => 'roles.create'])->assignRole($role1);
        Permission::create(['name' => 'roles.edit'])->assignRole($role1);
        Permission::create(['name' => 'roles.show'])->syncRoles([$role1, $role5]);
        Permission::create(['name' => 'roles.delete'])->assignRole($role1);
        Permission::create(['name' => 'permissions.index'])->syncRoles([$role1, $role5]);
        Permission::create(['name' => 'permissions.create'])->assignRole($role1);
        Permission::create(['name' => 'permissions.edit'])->assignRole($role1);
        Permission::create(['name' => 'permissions.show'])->assignRole($role1);
        Permission::create(['name' => 'permissions.delete'])->assignRole($role1);

        Permission::create(['name' => 'users.index'])->syncRoles([$role1, $role5]);
        Permission::create(['name' => 'users.profile'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'users.create'])->assignRole($role1);
        Permission::create(['name' => 'users.edit'])->assignRole($role1);
        Permission::create(['name' => 'users.assign'])->assignRole($role1);
        Permission::create(['name' => 'users.show'])->assignRole($role1);
        Permission::create(['name' => 'users.delete'])->assignRole($role1);

        Permission::create(['name' => 'alumnos.index'])->syncRoles([$role1, $role4, $role5]);
        Permission::create(['name' => 'alumnos.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'alumnos.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'alumnos.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'alumnos.delete'])->syncRoles([$role1, $role4]);

        Permission::create(['name' => 'docentes.index'])->syncRoles([$role1, $role4, $role5]);
        Permission::create(['name' => 'docentes.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'docentes.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'docentes.assign'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'docentes.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'docentes.delete'])->syncRoles([$role1, $role4]);

        Permission::create(['name' => 'secretarias.index'])->syncRoles([$role1, $role5]);
        Permission::create(['name' => 'secretarias.create'])->assignRole($role1);
        Permission::create(['name' => 'secretarias.edit'])->assignRole($role1);
        Permission::create(['name' => 'secretarias.show'])->assignRole($role1);
        Permission::create(['name' => 'secretarias.delete'])->assignRole($role1);

        Permission::create(['name' => 'cursos.index'])->syncRoles([$role1, $role4, $role5]);
        Permission::create(['name' => 'cursos.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'cursos.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'cursos.assign'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'cursos.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'cursos.delete'])->syncRoles([$role1, $role4]);

        Permission::create(['name' => 'aulas.index'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'aulas.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'aulas.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'aulas.assign'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'aulas.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'aulas.delete'])->syncRoles([$role1, $role4]);

        Permission::create(['name' => 'secciones.index'])->syncRoles([$role1, $role4, $role5]);
        Permission::create(['name' => 'secciones.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'secciones.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'secciones.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'secciones.delete'])->syncRoles([$role1, $role4]);

        Permission::create(['name' => 'periodos.index'])->syncRoles([$role1, $role4, $role5]);
        Permission::create(['name' => 'periodos.create'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'periodos.edit'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'periodos.show'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'periodos.delete'])->syncRoles([$role1, $role4]);
    }
}