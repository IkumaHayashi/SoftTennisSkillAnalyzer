<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
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
     * 関連のあるOrganizationオブジェクトを返す
     *
     * @return \App\Models\Organization $user
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
