<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'author_id'=>User::all()->random()->id,
        'article_id'=>Article::all()->random()->id,
        'body' => $faker->text(100)

    ];
});
