<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoinLaunchpadTeamMember extends Model
{
    protected $table = 'coin_launchpad_team_members';

    protected $fillable = [
        'coin_launchpad_id',
        'name',
        'role',
        'external_url',
        'sort_order',
    ];

    public function launchpad(): BelongsTo
    {
        return $this->belongsTo(CoinLaunchpad::class, 'coin_launchpad_id');
    }
}
