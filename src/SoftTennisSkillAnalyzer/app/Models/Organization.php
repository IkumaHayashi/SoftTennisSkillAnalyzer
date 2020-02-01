<?php

namespace App\Models;

use App\Models\Model;

class Organization extends CamelModel
{
    /**
     * Organizationモデルのインスタンスを作成する
     *
     * @param \App\User $user
    */
    public function __construct(\App\User $user)
    {
        $this->user_id = $user->id;
    }

    /**
     * 作成したUserオブジェクトを返す
     *
     * @return \App\User $user
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
