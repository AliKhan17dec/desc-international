<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coin extends Model
{
    protected $fillable = [
        'name','symbol','slug',
        'coin_type_id','category_id',
        'logo','description',
        'is_active','show_in_trending','trending_rank','show_in_gainers',
        'mindshare','volume_percentage_24h',
        'marketcap','price','price_change',
        'volume_24h','holders','marketcap_trend',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'coin_type_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function chains(): BelongsToMany
    {
        return $this->belongsToMany(Chain::class, 'coin_chain');
    }

    /**
     * Bridge curated coin -> market pairs created by your SyncCryptoExchanges command.
     * trading_pairs.base_asset matches coins.symbol
     */
    public function tradingPairs(): HasMany
    {
        return $this->hasMany(TradingPair::class, 'base_asset', 'symbol');
    }
}

