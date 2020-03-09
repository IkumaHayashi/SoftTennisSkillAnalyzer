<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PointKindSeeder;

class PointKindTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function シードがエラーなく動作する()
    {
        $this->seed(PointKindSeeder::class);
        $this->assertTrue(true);
    }
}
