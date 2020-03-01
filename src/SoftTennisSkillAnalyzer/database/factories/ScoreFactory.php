<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Score::class, function (Faker $faker) {

    $players = factory(\App\Models\Player::class, 4)->create();
    $user = $players[0]->user;
    foreach ($players as $player) {
            $player->user_id = $user->id;
            $player->save();
    }
    return [
        'user_id' => $user->id,
        'player1_1_id' => $players[0]->id,
        'player1_2_id' => $players[1]->id,
        'player2_1_id' => $players[2]->id,
        'player2_2_id' => $players[3]->id,
        'note' => '',
    ];
});
