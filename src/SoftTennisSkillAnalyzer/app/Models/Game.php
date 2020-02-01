<?php

namespace App\Models;

class Game extends CamelModel
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
     * 関連のあるScoreオブジェクトを返す
     *
     * @return \App\User $user
     */
    public function score()
    {
        return $this->belongsTo(\App\Models\Score::class);
    }
}

