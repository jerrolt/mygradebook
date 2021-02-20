<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstname,
        'lastname' =>  $faker->lastname,
        'birthday' => now()
    ];
});
