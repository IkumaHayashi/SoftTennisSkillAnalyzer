<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Score::class, function (Faker $faker) {

    $scoreType = new \App\Models\ScoreType();
    $scoreType->name = 'シングルス';
    $scoreType->save();

    $players = factory(\App\Models\Player::class, 4)->create();
    $user = $players[0]->user;
    foreach ($players as $player) {
            $player->user_id = $user->id;
            $player->save();
    }
    
    return [
        'user_id' => $user->id,
        'player1_a_id' => $players[0]->id,
        'player1_b_id' => $players[1]->id,
        'player2_a_id' => $players[2]->id,
        'player2_b_id' => $players[3]->id,
        'note' => '',
        'match_day' => new DateTime(),
        'score_type_id' => $scoreType->id,
    ];
});
