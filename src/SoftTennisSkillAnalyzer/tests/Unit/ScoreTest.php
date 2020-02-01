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
        //実行
        $score = factory(\App\Models\Score::class)->create();

        //検証
        $this->assertNotNull($score->user->id);
        $this->assertNotNull($score->player1_1->id);
        $this->assertNotNull($score->player1_2->id);
        $this->assertNotNull($score->player2_1->id);
        $this->assertNotNull($score->player2_2->id);
        
    }
}
