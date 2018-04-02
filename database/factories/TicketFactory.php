<?php

use Faker\Generator as Faker;

$factory->define(Misfits\Ticket::class, function (Faker $faker) {
    return [
        'author_id'   => factory(Misfits\User::class)->create()->id, 
        'assignee_id' => factory(Misfits\User::class)->create()->id, 
        'category_id' => factory(Misfits\Category::class)->create()->id,
        'is_open'     => $faker->boolean, 
        'slug'        => $faker->slug,
        'title'       => $faker->sentence(1),
        'description' => $faker->paragraph, 
        'closed_at'   => $faker->date
    ];
});
