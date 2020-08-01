<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dosage;
use App\Models\Product;
use App\Models\Culture;
use App\Models\Prague;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;



$factory->define(Dosage::class, function (Faker $faker) {
    return [
        'dosage' => rand(1, 2000) . Arr::random(['mL', 'Kg', 'g', 'cL']),
        'product_id' => factory(Product::class),
        'culture_id' => factory(Culture::class),
        'prague_id' => factory(Prague::class),
    ];
});
