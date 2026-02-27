<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoinLaunchpadBlock extends Model
{
    protected $table = 'coin_launchpad_blocks';

    protected $fillable = [
        'coin_launchpad_id',
        'sort_order',
        'type',
        'title',
        'body_text',
        'image_path',
        'external_link',
    ];

    public function launchpad(): BelongsTo
    {
        return $this->belongsTo(CoinLaunchpad::class, 'coin_launchpad_id');
    }
}
