<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body'=> $faker->paragraph,
        'image'=> $faker->imageUrl($width = 640, $height = 480),
    ];
});
