<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Users
      $users = ['joelmite19@gmail.com', 'juangarcia19@gmail.com', 'manolopalacios19@gmail.com'];
      foreach ($users as $user_email) {
        $user = User::create([
          'email' => $user_email,
          'email_verified_at' => now(),
          'password' => bcrypt('12345678'),
          'remember_token' => Str::random(10),
        ]);

        // Users - Persons
        $user->person()->save(
          factory(Person::class)->make()
        );

        // Users - Roles
        $user->roles()->sync([$user->id]);
        if ($user->id == 1) {
          $user->roles()->attach([2]);
        }

        // Users - Specialties
        if ($user->id != 3) {
          $user->specialties()->sync([1]);
        }

      }

      // User::create([
      //   //'name' => 'Joel',
      //   'email' => 'joelmite19@gmail.com',
      //   'email_verified_at' => now(),
      //   'password' => bcrypt('12345678'), // password
      //   'remember_token' => Str::random(10),
      // ]);
      //
      // User::create([
      //   //'name' => 'Joel',
      //   'email' => 'juangarcia19@gmail.com',
      //   'email_verified_at' => now(),
      //   'password' => bcrypt('12345678'), // password
      //   'remember_token' => Str::random(10),
      // ]);

    }
}
