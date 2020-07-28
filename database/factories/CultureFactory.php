<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Culture;
use Faker\Generator as Faker;

$factory->define(Culture::class, function (Faker $faker) {
    return [
        'name' => $faker->realText('20'),
    ];
});
