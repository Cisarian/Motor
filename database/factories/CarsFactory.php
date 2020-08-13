<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\cars;
use Faker\Generator as Faker;

$factory->define(cars::class, function (Faker $faker) {
    return [
        'make'=> $faker->company,
        'model'=>$faker->name,
        'registration' =>$faker->hexcolor,
        'color' => $faker->colorName,

    ];
});



