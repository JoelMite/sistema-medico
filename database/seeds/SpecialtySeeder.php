<?php

use Illuminate\Database\Seeder;
use App\specialty;
use App\User;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $specialty = Specialty::create([
        'name' => 'Medico Familiar',
        'description' => 'Brinda atención médica continua e integral para el individuo y la familia.',
      ]);
      $specialty->users()->saveMany(
        factory(User::class, 3)->make()
      );
    }
}
