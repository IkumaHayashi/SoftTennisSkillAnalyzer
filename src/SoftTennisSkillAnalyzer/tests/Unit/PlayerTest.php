<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

class PlayerTest extends TestCase
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
    public function Userが参照出来る()
    {
        //前準備
        //実行
        $player = factory(\App\Models\Player::class)->create();

        //検証
        $this->assertNotNull($player->user);
        
    }
}
