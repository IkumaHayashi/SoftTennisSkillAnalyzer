<?php

namespace App\Models;

use App\Models\Model;

class Organization extends CamelModel
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
