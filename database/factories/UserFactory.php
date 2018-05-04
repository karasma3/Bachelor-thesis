<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Player::class, function (Faker $faker) {
    $name = $faker->firstName;
    $surname = $faker->lastName;
    return [
        'name' => $name,
        'surname' => $surname,
        'email' => strtolower($name.'.'.$surname.'@example.com'),
        'password' => Hash::make('12345'), // secret
        'remember_token' => str_random(10),
    ];
});
