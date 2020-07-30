<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dosage;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Dosage::class, function (Faker $faker) {
    return [
        'dosage' => rand(1, 900) . Arr::random(['mL', 'Kg', 'g', 'cL']) . ' de ' .
            Arr::random(['Adubo Químico', 'Bicarbonato de Sódio', 'Fertilizante', 'Fermento Químico', 'Sal de Arruda']),
        'product_id' => rand(1, 20),
        'culture_id' => rand(1, 20),
        'prague_id' => rand(1, 20),
    ];
});
