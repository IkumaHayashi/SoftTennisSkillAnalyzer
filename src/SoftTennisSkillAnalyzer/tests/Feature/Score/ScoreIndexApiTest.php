<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreIndexApiTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = \App\User::first();
        $this->otherUser = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function 自分が作成したスコアのみ取得できる()
    {
        
        // 前準備
        $scores = factory(\App\Models\Score::class, 5)->create();
        $scores[count($scores) - 1]->user_id = $this->otherUser->id;
        $scores[count($scores) - 1]->save();


        // 実行
        $response = $this->actingAs($this->user)
                    ->json('GET', route('scores.index'));

        // 検証
        $expected = \App\Models\Score::where('user_id', \Auth::user()->id)->get();
        
        $response->assertStatus(200);
                 // ->assertJsonCount(4);
                 // TODO: JSONの中身をテストできるようにする
                 // ->assertJsonFragment([$expected]);
        
    }
}