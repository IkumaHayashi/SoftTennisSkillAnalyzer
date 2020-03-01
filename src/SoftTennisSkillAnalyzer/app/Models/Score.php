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
    
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_1()
    {
        return $this->player(__FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_2()
    {
        return $this->player(__FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_1()
    {
        return $this->player(__FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_2()
    {
        return $this->player(__FUNCTION__ . '_id');
    }

    /**
     * 渡されたplayer番号のオブジェクトを返す
     *
     * @param string $attributeName
     * @return \App\Models\Player
     */
    private function player(string $attributeName)
    {
        return $this->belongsTo(\App\Models\Player::class, $attributeName);
    }
}
