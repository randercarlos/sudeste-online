<?php

use App\Models\Culture;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use \Illuminate\Support\Arr;

$factory->define(Culture::class, function (Faker $faker) {
    return [
        'name' => Arr::random(['Plantação de Arroz', 'Plantação de Milho', 'Plantação de Alface',
                'Pé de Maças', 'Morangueiro', 'Videira', 'Plantação de Abacaxi', 'Plantação de Tomates', 'Canavial'])
            . ' ' . Str::random(5)
    ];
});
