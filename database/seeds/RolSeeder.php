<?php

use Illuminate\Database\Seeder;
use App\rol;

class RolSeeder extends Seeder
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
        Rol::create([
          'name' => 'Administrador',
          'description' => 'Se encargara de gestionar los roles y usuarios',
        ]);

        Rol::create([
          'name' => 'Medico',
          'description' => 'Se encargara de gestionar las historias clinicas, consultas medicas, citas medicas y pacientes',
        ]);

        Rol::create([
          'name' => 'Paciente',
          'description' => 'Se encargara de gestionar sus citas medicas',
        ]);
      }
}
