<?php

use Faker\Generator as Faker;

$factory->define(App\ContactForm::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'message' => $faker->paragraph,
    ];
});
