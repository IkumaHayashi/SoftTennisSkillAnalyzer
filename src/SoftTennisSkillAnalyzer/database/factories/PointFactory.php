<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Point::class, function (Faker $faker) {

    $scoreKind = new \App\Models\ScoreKind();
    $scoreKind->name = 'サービス';
    $scoreKind->description = 'プレーを開始するとき(ポイントの最初)の打球';
    $scoreKind->save();

    $game = factory(\App\Models\Game::class)->create();

    return [
        'game_id' => $game->id,
        'score_player_id' => $game->score->player1_1->id,
        'score_kind_id' => $scoreKind->id,
        'is_winner' => true,
    ];
    
});
