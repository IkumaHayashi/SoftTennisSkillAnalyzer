<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function User、Scoreが参照出来る()
    {
        //前準備
        //実行
        $game = factory(\App\Models\Game::class)->create();

        //検証
        $this->assertNotNull($game->user->id);
        $this->assertNotNull($game->score->id);
        
    }
}
