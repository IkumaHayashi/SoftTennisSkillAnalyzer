<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function User、Playerが参照出来る()
    {
        //前準備
        $players = factory(\App\Models\Player::class, 4)->create();
        $user = $players[0]->user;
        foreach ($players as $player) {
             $player->userId = $user->id;
             $player->save();
        }

        //実行
        $score = new \App\Models\Score();
        $score->userId = $user->id;
        $score->player1_1Id = $players[0]->id;
        $score->player1_2Id = $players[1]->id;
        $score->player2_1Id = $players[2]->id;
        $score->player2_2Id = $players[3]->id;
        $score->save();

        //検証
        $this->assertNotNull($score->user->id);
        $this->assertNotNull($score->player1_1->id);
        $this->assertNotNull($score->player1_2->id);
        $this->assertNotNull($score->player2_1->id);
        $this->assertNotNull($score->player2_2->id);
        
    }
}
