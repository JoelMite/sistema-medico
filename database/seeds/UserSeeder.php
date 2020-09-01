<?php

use Illuminate\Database\Seeder;
use App\User;
use App\person;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = ['joelmite19@gmail.com', 'juangarcia19@gmail.com', 'manolopalacios19@gmail.com'];
      foreach ($users as $user_email) {
        $user = User::create([
          'email' => $user_email,
          'email_verified_at' => now(),
          'password' => bcrypt('12345678'),
          'remember_token' => Str::random(10),
        ]);
        $user->persons()->save(
          factory(Person::class)->make()
        );
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
