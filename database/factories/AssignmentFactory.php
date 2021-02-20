<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        'name' => $faker->name . ' Assignment',
        'date_due' =>  now() // $faker->date_due  
    ];
});
