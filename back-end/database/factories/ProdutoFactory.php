<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text,
        'price' => rand(100,1000000)
    ];
});
