<?php

use App\Models\Prague;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Prague::class, function (Faker $faker) {
    return [
        'name' => Str::random(20),
    ];
});
