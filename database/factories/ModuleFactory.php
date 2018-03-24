<?php

use Faker\Generator as Faker;
use App\Module;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(),
        'course_id'   => 1
    ];
});
