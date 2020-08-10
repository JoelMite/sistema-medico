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
        $rols = [
          'Administrador',
          'Medico'
        ];

        foreach ($rols as $rol) {
          Rol::create([
            'name' => $rol
          ]);
        }
      }
}
