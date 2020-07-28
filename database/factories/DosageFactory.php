<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dosage;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Dosage::class, function (Faker $faker) {
    return [
        'dosage' => Arr::random(range(1, 999)) . Arr::random(['mL', 'Kg', 'g', 'cL']),
        'product_id' => Arr::random(range(1, 20)),
        'culture_id' => Arr::random(range(1, 20)),
        'prague_id' => Arr::random(range(1, 20)),

    ];
});
