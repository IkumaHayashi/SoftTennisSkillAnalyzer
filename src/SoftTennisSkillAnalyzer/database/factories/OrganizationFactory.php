<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Organization::class, function (Faker $faker) {
    
    $user = \App\User::first();
    return [
        'name' => 'そふてにあっぷクラブ',
        'user_id' => $user->id,
    ];
});
