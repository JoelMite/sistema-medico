<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'age' => mt_rand(1,50),
        'etnia' => $faker->randomElement(['Mestizo','Indigena','Afroamericano']),
        'sex' => $faker->randomElement(['Masculino','Femenino']),
    ];
});
