<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
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
    public function OraganizationからUserが参照出来る()
    {
        //実行
        $organization = factory(\App\Models\Organization::class)->create();

        //検証
        $this->assertNotNull($organization->user->id);
        
    }
}
