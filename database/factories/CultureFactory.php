<?php

use App\Models\Culture;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Culture::class, function (Faker $faker) {
    return [
        'name' => Str::random(15),
    ];
});
