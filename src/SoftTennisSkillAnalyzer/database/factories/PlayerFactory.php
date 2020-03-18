<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Player::class, function (Faker $faker) {

    $user = \App\User::first();

    return [
        'name' => $faker->name,
        'user_id' => $user->id
    ];
});
