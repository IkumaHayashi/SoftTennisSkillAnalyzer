<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use ScoreKindSeeder;

class ScoreKindTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function シードがエラーなく動作する()
    {
        $this->seed(ScoreKindSeeder::class);
        $this->assertTrue(true);
    }
}
