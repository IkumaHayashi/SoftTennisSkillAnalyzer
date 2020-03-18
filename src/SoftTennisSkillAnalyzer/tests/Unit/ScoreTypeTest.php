<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use ScoreTypeSeeder;

class ScoreTypeTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * @test
     *
     * @return void
     */
    public function シードがエラーなく動作する()
    {
        $this->seed(ScoreTypeSeeder::class);
        $this->assertTrue(true);
    }
}
