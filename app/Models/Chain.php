<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chain extends Model
{
    protected $fillable = ['name', 'slug', 'symbol', 'icon', 'is_active'];

    public function coins(): BelongsToMany
    {
        return $this->belongsToMany(Coin::class);
    }
}

