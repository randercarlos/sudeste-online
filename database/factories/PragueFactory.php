<?php

use App\Models\Prague;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Prague::class, function (Faker $faker) {
    return [
        'name' => Arr::random(['Nuvem de Gafanhotos', 'Ratos de esgoto', 'Cupins',
                'Traças', 'Besouros', 'Formigas vermelhas', 'Aranhas', 'Lagartixas']) . ' ' . Str::random(5) ,
    ];
});
