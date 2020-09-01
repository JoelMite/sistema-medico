<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\rol;
use Faker\Generator as Faker;

$factory->define(Rol::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'description' => $faker->lastname,
    ];
});
