<?php

use Faker\Generator as Faker;

$factory->define(Misfits\Petition::class, function (Faker $faker): array {
    return [
       'author_id' => factory(Misfits\User::class)->create()->id, 
       'category_id' => factory(Misfits\Category::class)->create()->id,
       'title' => $faker->sentence, 
       'slug' => $faker->slug, 
       'decision_maker' => $faker->name,
       'text' => $faker->paragraph,
    ];
});
