<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'descripcion'=> $faker->text(50),
        'estado'=> $faker->boolean(),
        'archivo'=> $faker->text(200)
    ];
});
