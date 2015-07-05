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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Document::class, function ($faker) {
    return [
        'reference' => $faker->bothify('?#########?'),
        'customer' => $faker->name,
        'street_address' => $faker->streetAddress,
        'street_name' => $faker->streetName,
        'city' => $faker->city,
        'state' => $faker->state,
        'postcode' => $faker->postcode,
        'currency' => $faker->randomElement(['GBP', 'USD', 'EUR']),
        'value' => $faker->numberBetween(100, 20000),
    ];
});
