<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name'          => $faker->lastName,
        'description'   => $faker->optional()->sentence(),
        'code'          => $faker->regexify('IK-[A-Z]{3}[0-9]{3}'),
        'credit'        => $faker->randomDigit,
        'public'        => $faker->boolean,
    ];
});
