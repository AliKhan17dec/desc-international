<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoinLaunchpad extends Model
{
    protected $table = 'coin_launchpads';

    protected $fillable = [
        'coin_id',
        'category_id',
        'slug',
        'status',
        'summary_text',
        'phase_steps',
        'highlight_stats',
        'value_capture_text',
    ];

    protected $casts = [
        'phase_steps' => 'array', // [{ step_name: string, done: bool }]
        'highlight_stats' => 'array', // [{ label: string, value: string }]
    ];

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(CoinLaunchpadBlock::class)->orderBy('sort_order');
    }

    public function teamMembers(): HasMany
    {
        return $this->hasMany(CoinLaunchpadTeamMember::class)->orderBy('sort_order');
    }

    public function externalLinks(): HasMany
    {
        return $this->hasMany(CoinLaunchpadExternalLink::class)->orderBy('sort_order');
    }
}
