<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => 'secret',
        'role_id' => \App\Role::all()->random()->id
    ];
});

$factory->define(\App\Member::class, function (\Faker\Generator $faker) {
   return [
       'nickname' => $faker->firstName,
       'full_name' => $faker->name,
       'genre' => rand(0, 1),
       'email' => $faker->email,
       'phone' => $faker->phoneNumber,
       'address' => $faker->address
   ];
});

$factory->define(\App\Publisher::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'address' => $faker->address,
        'location' => $faker->city,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});