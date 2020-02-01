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
        $user = factory(\App\User::class)->make();
        $user->save();
        $organization = factory(\App\Models\Organization::class)->make();
        $organization->user_id = $user->id;
        $organization->save();

        //実行
        $player = factory(\App\Models\Player::class)->make();
        $player->user_id = $user->id;
        $player->organization_id = $organization->id;
        $player->save();

        //検証
        $this->assertSame($user->id, $player->user->id);
        $this->assertSame($organization->id, $player->organization->id);
        
    }
}
