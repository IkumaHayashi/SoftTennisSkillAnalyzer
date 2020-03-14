<?php

namespace Tests\Feature;

use App\User;
use App\Models\Score;
use App\Models\ScoreType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreStoreApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function スコアを投稿できる()
    {
        
        // 前準備
        // プレイヤーを4人分作成して所有のUserをあとから変える
        $players = factory(\App\Models\Player::class, 4)->create();
        foreach ($players as $player) {
                $player->user_id = $this->user->id;
                $player->save();
        }
        $scoreType = new ScoreType();
        $scoreType->name = 'シングルス';
        $scoreType->save();

        // 実行
        $response = $this->actingAs($this->user)
                    ->json('POST', route('scores.store'),[
                        'player1_a' => $players[0],
                        'player1_b' => $players[1],
                        'player2_a' => $players[2],
                        'player2_b' => $players[3],
                        'score_type' => $scoreType,
                        'game_numbers' => 7,
                        'note' => 'テストデータ',
                        'match_day' => new \DateTime(),
                    ]);
        // 検証
        $response->assertStatus(201);
        $score = Score::first();
        $this->assertNotNull($score->player1_a->id);
        $this->assertNotNull($score->player1_b->id);
        $this->assertNotNull($score->player2_a->id);
        $this->assertNotNull($score->player2_b->id);
        $this->assertNotNull($score->note);
        $this->assertNotNull($score->match_day);
        $this->assertNotNull($score->game_numbers);
        
    }
}