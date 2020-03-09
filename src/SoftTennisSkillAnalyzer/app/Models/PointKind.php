<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointKind extends Model
{
    public function points(): HasMany
    {
        return $this->hasMany(\App\Models\Point::class);
    }
}
