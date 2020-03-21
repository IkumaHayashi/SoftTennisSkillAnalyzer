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
        $this->seed();
        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function スコアを投稿できる()
    {
        
        // 前準備
        $players = factory(\App\Models\Player::class, 4)->create();
        $scoreType = \App\Models\ScoreType::first();
        $organizations = \App\Models\Organization::take(2)->get();

        // 実行
        $response = $this->actingAs($this->user)
                    ->json('POST', route('scores.store'),[
                        'new_or_edit_score' => [
                            'organization1_name' => $organizations[0]->name,
                            'player1_a_name' => $players[0]->name,
                            'player1_b_name' => $players[1]->name,
                            'organization2_name' => $organizations[0]->name,
                            'player2_a_name' => $players[2]->name,
                            'player2_b_name' => $players[3]->name,
                            'score_type_id' => $scoreType->id,
                            'game_number' => 7,
                            'note' => 'テストデータ',
                            'match_day' => new \DateTime(),
                        ],
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
        $this->assertNotNull($score->game_number);
        
    }
}