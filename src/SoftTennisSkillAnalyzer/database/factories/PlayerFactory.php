<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Player::class, function (Faker $faker) {

    $organization = factory(\App\Models\Organization::class)->create();
    return [
        'name' => $faker->name,
        'organization_id' => $organization->id,
        'user_id' => $organization->user->id
    ];
});
