<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function User、Organizationが参照出来る()
    {
        //前準備
        //実行
        $player = factory(\App\Models\Player::class)->create();

        //検証
        $this->assertNotNull($player->user);
        $this->assertNotNull($player->organization);
        
    }
}
