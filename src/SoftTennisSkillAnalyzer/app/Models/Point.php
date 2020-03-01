<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Point extends Model
{
    /**
     * 関連のあるUserオブジェクトを返す
     *
     * @return \App\User $user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * 関連のあるPlayerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Player::class, 'score_player_id');
    }

    /**
     * 関連のあるScoreKindオブジェクトを返す
     *
     * @return \App\Models\ScoreKind $scoreKind
     */
    public function scoreKind() : BelongsTo
    {
        return $this->belongsTo(\App\Models\ScoreKind::class);
    }

    /**
     * 関連のあるGameオブジェクトを返す
     *
     * @return \App\Models\Game $game
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Game::class);
    }
}

