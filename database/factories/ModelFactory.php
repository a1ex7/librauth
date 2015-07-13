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
        'firstname' => $faker->firstName,
        'lastname'  => $faker->lastName,
        'email'     => $faker->email,
        'password'  => bcrypt('123456')
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'title' => $faker->text(30),
        'author' => $faker->lastName,
        'year' => $faker->numberBetween(1996, 2015),
        'genre' => $faker->randomElement(['History', 'Romance', 'Crime', 'Fiction', 'Poetry']),
    ];
});
