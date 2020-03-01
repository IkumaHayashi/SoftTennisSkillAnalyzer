<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
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

