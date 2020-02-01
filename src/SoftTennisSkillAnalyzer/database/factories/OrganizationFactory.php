<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Organization::class, function (Faker $faker) {

    return [
        'name' => 'そふてにあっぷクラブ',
        'user_id' =>factory(\App\User::class)->create()->id,
    ];
});
