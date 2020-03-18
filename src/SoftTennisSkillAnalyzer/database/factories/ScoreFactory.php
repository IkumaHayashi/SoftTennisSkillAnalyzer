<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Score::class, function (Faker $faker) {

    $user = \App\User::first();
    $scoreType = \App\Models\ScoreType::first();
    $players = factory(\App\Models\Player::class, 4)->create();
    $organizations = \App\Models\Organization::take(2)->get();
    
    return [
        'user_id' => $user->id,
        'organization1_id' => $organizations[0]->id,
        'player1_a_id' => $players[0]->id,
        'player1_b_id' => $players[1]->id,
        'organization2_id' => $organizations[1]->id,
        'player2_a_id' => $players[2]->id,
        'player2_b_id' => $players[3]->id,
        'note' => '',
        'match_day' => new DateTime(),
        'score_type_id' => $scoreType->id,
    ];
});
