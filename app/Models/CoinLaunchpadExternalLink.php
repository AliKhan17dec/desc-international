<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoinLaunchpadExternalLink extends Model
{
    protected $table = 'coin_launchpad_external_links';

    protected $fillable = [
        'coin_launchpad_id',
        'label',
        'url',
        'sort_order',
    ];

    public function launchpad(): BelongsTo
    {
        return $this->belongsTo(CoinLaunchpad::class, 'coin_launchpad_id');
    }
}
