<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function OraganizationからUserが参照出来る()
    {
        //前準備
        $user = factory(\App\User::class)->make();
        $user->save();
    
        //実行
        $organization = factory(\App\Models\Organization::class)->make();
        $organization->user_id = $user->id;
        $organization->save();

        //検証
        $this->assertSame($user->id, $organization->user->id);
        
    }
}
