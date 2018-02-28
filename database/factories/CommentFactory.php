<?php

use Faker\Generator as Faker;

$factory->define(Misfits\Comment::class, function (Faker $faker) {
    return [
        'ticket_id' => factory(Misfits\Ticket::class)->create()->id,
        'author_id' => factory(Misfits\User::class)->create()->id, 
        'comment'   => $faker->text
    ];
});
