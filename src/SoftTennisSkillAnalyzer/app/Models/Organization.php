<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
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
}
