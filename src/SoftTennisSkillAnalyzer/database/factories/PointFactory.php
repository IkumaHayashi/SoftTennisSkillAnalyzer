<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Point::class, function (Faker $faker) {

    $pointKind = new \App\Models\PointKind();
    $pointKind->name = 'サービス';
    $pointKind->description = 'プレーを開始するとき(ポイントの最初)の打球';
    $pointKind->save();

    $game = factory(\App\Models\Game::class)->create();

    return [
        'game_id' => $game->id,
        'end_player_id' => $game->score->player1_A->id,
        'point_kind_id' => $pointKind->id,
        'is_winner' => true,
    ];
    
});
