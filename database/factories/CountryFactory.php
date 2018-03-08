<?php

use Faker\Generator as Faker;

$factory->define(Misfits\Country::class, function (Faker $faker): array {
    return ['name' => $faker->country];
});
