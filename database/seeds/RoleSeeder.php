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

        $rols = ['Administrador', 'Medico', 'Paciente'];
        foreach ($rols as $rol_name) {
          $rol = Role::create([
            'name' => $rol_name,
            'description' => Str::random(20),
          ]);

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

        $rol->users()->save(
          factory(User::class)->make()
        );
      }
    }
}
