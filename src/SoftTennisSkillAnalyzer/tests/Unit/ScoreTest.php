<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed();
    }

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
        $this->assertNotNull($score->player1_a->id);
        $this->assertNotNull($score->player1_b->id);
        $this->assertNotNull($score->player2_a->id);
        $this->assertNotNull($score->player2_b->id);
        
    }
}
