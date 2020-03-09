<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use ScoreKindSeeder;

class PointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function User、Score、Game、ScoreKindが参照出来る()
    {
        //前準備
        //$this->seed(ScoreKindSeeder::class);

        //実行
        $point = factory(\App\Models\Point::class)->create();

        //検証
        $this->assertNotNull($point->game->id);
        $this->assertNotNull($point->scoreKind->id);
        $this->assertNotNull($point->player->id);
        
    }
}
