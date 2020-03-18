<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
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
    public function User、Scoreが参照出来る()
    {
        //前準備
        //実行
        $game = factory(\App\Models\Game::class)->create();

        //検証
        $this->assertNotNull($game->score->id);
        
    }
}
