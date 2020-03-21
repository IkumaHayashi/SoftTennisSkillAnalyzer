<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = \App\User::first();
    }

    /**
     * @test
     */
    public function User自身が作成した組織のみを取得できる()
    {
        //前準備
        $otherUser = factory(\App\User::class)->create();
        $otherUserOrganization = new \App\Models\Organization();
        $otherUserOrganization->name = '他のユーザーの組織';
        $otherUserOrganization->user_id = $otherUser->id;
        $otherUser->save();

        //実行
        $actualOrganizations = $this->user->organizations()->get();

        //検証
        $expectedOrganization = \App\Models\Organization::where('user_id', $this->user->id)->get();
        $this->assertSame(5, count($actualOrganizations));
        $this->assertEquals($expectedOrganization, $actualOrganizations);
        
    }

    /**
     * @test
     */
    public function User自身が作成した組織を名前指定で取得できる()
    {
        //前準備
        //実行
        $actualOrganization = $this->user->organization('金華クラブ');

        //検証
        $expectedOrganization = \App\Models\Organization::where('user_id', $this->user->id)
                                                              ->where('name', '金華クラブ')->first();
        $this->assertEquals($expectedOrganization, $actualOrganization);
        
    }
    /**
     * @test
     */
    public function User自身が作成した組織を名前指定して、存在しなかった作成して返す()
    {
        //前準備
        //実行
        $actualOrganization = $this->user->organization('今はない組織だよ');

        //検証
        $expectedOrganization = \App\Models\Organization::where('name', '今はない組織だよ')
                                                        ->where('user_id', $this->user->id)
                                                        ->first();
        $this->assertEquals($expectedOrganization->id, $actualOrganization->id);
        $this->assertEquals($expectedOrganization->name, $actualOrganization->name);
                                                        
        
    }
    /**
     * @test
     */
    public function User自身が作成したプレイヤーのみを取得できる()
    {
        //前準備
        $otherUser = factory(\App\User::class)->create();
        $otherUserPlayer = new \App\Models\Player();
        $otherUserPlayer->name = '他のユーザーのプレイヤー';
        $otherUserPlayer->user_id = $otherUser->id;
        $otherUser->players()->save($otherUserPlayer);

        //実行
        $myPlayer = factory(\App\Models\Player::class)->create();
        $myPlayer->user_id = $this->user->id;
        $myPlayer->save();

        $actualPlayer = $this->user->players()->orderBy('id', 'desc')->first();

        //検証
        $expectedPlayer = \App\Models\Player::where('user_id', $this->user->id)
                                                 ->orderBy('id', 'desc')
                                                 ->first();
        $this->assertEquals($expectedPlayer->id, $actualPlayer->id);
        $this->assertEquals($expectedPlayer->name, $actualPlayer->name);
        
    }

    /**
     * @test
     */
    public function User自身が作成したプレイヤーを名前指定で取得できる()
    {
        //前準備
        $testName = $this->faker->name;
        $player = new \App\Models\Player();
        $player->name = $testName;
        $player->user_id = $this->user->id;
        $player->save();

        //実行
        $actualPlayer = $this->user->player($testName);

        //検証
        $expectedPlayer = \App\Models\Player::where('user_id', $this->user->id)
                                                              ->where('name', $testName)->first();
        $this->assertEquals($expectedPlayer->id, $actualPlayer->id);
        $this->assertEquals($expectedPlayer->name, $actualPlayer->name);
        
    }
    /**
     * @test
     */
    public function User自身が作成したプレイヤーを名前指定して、存在しなかった作成して返す()
    {
        //前準備
        //実行
        $testName = $this->faker->name;
        $actualPlayer = $this->user->player($testName);

        //検証
        $expectedPlayer = \App\Models\Player::where('name', $testName)
                                                        ->where('user_id', $this->user->id)
                                                        ->first();
        $this->assertEquals($expectedPlayer->id, $actualPlayer->id);
        $this->assertEquals($expectedPlayer->name, $actualPlayer->name);
                                                        
        
    }
}
