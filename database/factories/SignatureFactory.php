<?php

use Faker\Generator as Faker;
use Misfits\{Signature, Country};

$factory->define(Misfits\Signature::class, function (Faker $faker): array {
    return [
        'petition_id' => factory(Signature::class)->create()->id,
        'country_id'  => factory(Country::class)->create()->id,
        'firstname'   => $faker->firstName,
        'lastname'    => $faker->lastName,
        'city'        => $faker->city,
        'email'       => $faker->email,
    ];
});
