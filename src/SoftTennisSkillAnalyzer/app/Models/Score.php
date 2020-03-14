<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * 関連のあるUserオブジェクトを返す
     *
     * @return \App\User $user
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function score_type()
    {
        return $this->belongsTo(ScoreType::class);
    }
    
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_a()
    {
        return $this->player('player1_a_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_b()
    {
        return $this->player(__FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_a()
    {
        return $this->player(__FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_b()
    {
        return $this->player(__FUNCTION__ . '_id');
    }

    /**
     * 渡されたplayer番号のオブジェクトを返す
     *
     * @param string $attributeName
     * @return Player
     */
    private function player(string $attributeName)
    {
        return $this->belongsTo(Player::class, $attributeName);
    }
}
