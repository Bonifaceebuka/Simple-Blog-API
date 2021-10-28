<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'admin_id' => rand(1, 10),
        'category_id' => rand(1, 10),
        'poster' => 'poster.png',
        'description' => $faker->paragraph(30),
    ];
});
