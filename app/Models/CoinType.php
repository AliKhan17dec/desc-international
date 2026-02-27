<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoinType extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'icon'];

    public function coins(): HasMany
    {
        return $this->hasMany(Coin::class);
    }
}


