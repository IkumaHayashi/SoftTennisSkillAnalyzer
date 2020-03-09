<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function User、Score、Game、PointKindが参照出来る()
    {
        //前準備
        //実行
        $point = factory(\App\Models\Point::class)->create();

        //検証
        $this->assertNotNull($point->game->id);
        $this->assertNotNull($point->pointKind->id);
        $this->assertNotNull($point->player->id);
        
    }
}
