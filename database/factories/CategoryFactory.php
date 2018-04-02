<?php

use Faker\Generator as Faker;

$factory->define(Misfits\Category::class, function (Faker $faker): array {
    return [
        'author_id' => function (): int {
            return factory(Misfits\User::class)->create()->id;
        },
        'slug' => $faker->name,
        'module' => $faker->name,
        'color' => $faker->hexColor,
        'name' => $faker->name,
        'description' => $faker->realText,
    ];
});
