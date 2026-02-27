<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopyTrader extends Model
{
    protected $table = 'copy_traders';

    protected $casts = [
        'badges' => 'array',
        'asset_preferences' => 'array',
        'position_history' => 'array',
    ];

    protected $fillable = [
        'name',
        'username',
        'profile_picture',
        'email',
        'bio',
        'risk_level',
        'level',
        'trading_style',
        'status',
        'badges',
        'followers',
        'copiers',
        'trades',
        'win_trades',
        'win_rate',
        'total_aum',
        'roi',
        'pnl',
        'sharp_ratio',
        'mdd',
        'profit_sharing',
        'lead_balance',
        'min_copy_amount',
        'max_copy_amount',
        'member_since',
        'asset_preferences',
        'position_history',
    ];
    protected $appends = [
        'profile_picture_url',  // so you can use $trader->profile_picture_url in Blade
    ];

    public function getProfilePictureUrlAttribute(): string
    {
        if (!$this->profile_picture) {
            // fallback image in public/images/defaults/copytrader.png (you create this)
            return asset('images/defaults/copytrader.png');
        }

        // If admin pasted a full URL instead of an uploaded file path
        if (Str::startsWith($this->profile_picture, ['http://', 'https://'])) {
            return $this->profile_picture;
        }

        // otherwise treat as storage path
        return asset('storage/' . ltrim($this->profile_picture, '/'));
    }
    public function feeProfitRanges()
    {
        return $this->hasMany(CopyTraderFeeProfit::class, 'copy_trader_id');
    }
    public function traderPackages()
    {
        return $this->hasMany(CopyTraderPackage::class);
    }

    public function availablePackages()
    {
        // Only active trader-package configs with active global packages
        return $this->traderPackages()
            ->where('is_active', true)
            ->whereHas('copyTradingPackage', function ($q) {
                $q->where('is_active', true);
            });
    }

}
