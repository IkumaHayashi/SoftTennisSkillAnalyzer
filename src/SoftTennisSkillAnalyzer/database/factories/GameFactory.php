<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Game::class, function (Faker $faker) {

    $score = factory(\App\Models\Score::class)->create();
    return [
        'score_id' => $score->id,
        'count1' => 1,
        'count2' => 2,
    ];
    
});
