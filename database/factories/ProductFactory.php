<?php

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => Arr::random(['Adubo Químico', 'Bicarbonato de Sódio', 'Fertilizante', 'Fermento Químico', 'Sal de Arruda',
                'Soda Caústica', 'Iodo', 'Açúcar Mascavo', 'Conservante', 'Agrotóxico', 'Inseticida', 'Pesticida'])
            . ' ' . Str::random(5) ,
    ];
});
