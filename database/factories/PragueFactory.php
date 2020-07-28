<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Prague;
use Faker\Generator as Faker;

$factory->define(Prague::class, function (Faker $faker) {
    return [
        'name' => $faker->realText('20'),
    ];
});
