<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        //$this->call(SpecialtySeeder::class);
        //$this->call(RolSeeder::class);
        $this->call([
          PermissionSeeder::class,
          RoleSeeder::class,
          SpecialtySeeder::class,
          UserSeeder::class,
          WorkDaySeeder::class,
        ]);
    }
}
