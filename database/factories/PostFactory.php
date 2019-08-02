<?php

use Faker\Generator as Faker;
use App\Models\Blog\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'slug' => $faker->sentence(mt_rand(3, 10)),
        'title' => $faker->sentence(mt_rand(3, 10)),
        'content' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    ];
});
