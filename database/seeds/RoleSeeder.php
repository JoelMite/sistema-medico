<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Person;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $rols = [
        //   'Administrador',
        //   'Medico'
        // ];
        //
        // foreach ($rols as $rol) {
        //   Rol::create([
        //     'name' => $rol
        //   ]);
        // }

        $roles = ['Administrador', 'Medico', 'Paciente'];
        foreach ($roles as $rol_name) {
          $role = Role::create([
            'name' => $rol_name,
            'description' => Str::random(20),
          ]);


        

        if ($role->id == 1) { // Administrador
          $role->permissions()->sync([15,16,17,18,23,24,25,26,27,28,29,30,31,32,33,34]);
        }elseif ($role->id == 2) { // Medico
          $role->permissions()->sync([1,2,3,4,5,6,7,8,9,11,13,14,19,20,21,22,23,35]);
        }else { // Paciente
          $role->permissions()->sync([10,12,14,23,36]);
        }

        // Rol::create([
        //   'name' => 'Administrador',
        //   'description' => 'Se encargara de gestionar los roles y usuarios',
        // ]);
        //
        // Rol::create([
        //   'name' => 'Medico',
        //   'description' => 'Se encargara de gestionar las historias clinicas, consultas medicas, citas medicas y pacientes',
        // ]);
        //
        // Rol::create([
        //   'name' => 'Paciente',
        //   'description' => 'Se encargara de gestionar sus citas medicas',
        // ]);

        // $rol->users()->save(
        //   factory(User::class)->make()
        // );
      }
    }
}
