<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreUpdateApiTest extends TestCase
{
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
    public function 編集対象のScoreオブジェクトを取得できる()
    {
        
        // 前準備
        $score = factory(\App\Models\Score::class)->create();
        $score->user_id = $this->user->id;
        $score->save();

        // 実行
        $response = $this->actingAs($this->user)
                    ->json('GET', route('scores.edit', [
                        'id' => $score->id,
                    ]));
        // 検証
        //$expected = \App\Models\Score::where('user_id', \Auth::user()->id)->get();
        
        $response->assertStatus(200);
                 // ->assertJsonCount(4);
                 // TODO: JSONの中身をテストできるようにする
                 // ->assertJsonFragment([$expected]);
        
    }
}