<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Exchange;
use App\Models\TradingPair;

class SyncCryptoExchanges extends Command
{
    protected $signature = 'sync:crypto-exchanges';
    protected $description = 'Fetch exchanges from CoinGecko and create USDT pairs for DeSci coins only';

    /**
     * Client-provided DeSci tickers (from your CSV).
     * NOTE: Client list had duplicates: DESCI (2x) and DNA (2x) — duplicates removed here.
     */
    protected array $desciSymbols = [
        'TRAC', 'BIO', 'HAIR', 'RSC', 'TIG', 'GALEON', 'VITA', 'AXGT',
        'BLZ', 'AUBRAI', 'SLC', 'DNX', 'GROW', 'GRC', 'NEURON', 'SPINE',
        'ATH', 'FACT', 'YNE', 'SCI', 'HERO', 'GLQ', 'ORA', 'HPO', 'NIOX',
        'NMR', 'VEC2', 'RIZ', 'DNA', 'SUIAI', 'SOL', 'SNP', 'VARA', 'MED',
        'LQTY', 'LIT', 'ONDO', 'ALCX', 'ZENT', 'DIMO', 'XRT', 'CPOOL',
        'SOLAR', 'CETUS', 'SMILE', 'SLERF', 'FUEL', 'SOLS', 'BID', 'OVO',
        'WOLF', 'CERE', 'FI', 'AHT', 'SWARMS', 'AGIX', 'OORT', 'LYRA',
        'TRIBE', 'ZBC', 'RENDER', 'ALPH', 'SYN', 'GALA', 'KAS', 'VRA',
        'AIOZ', 'BEL', 'GLM', 'ORAI', 'POND', 'GAS', 'TNSR', 'DUA',
        'DESCI', 'RMRK', 'XCH', 'LUNA', 'MVEDA', 'MOONEY', 'SBIO',
    ];

    public function handle(): void
    {
        $this->info("🔄 Fetching exchanges from CoinGecko...");

        $exchangeResponse = Http::get('https://api.coingecko.com/api/v3/exchanges');

        if (!$exchangeResponse->successful()) {
            $this->error("❌ Failed to fetch exchanges.");
            return;
        }

        $exchanges = $exchangeResponse->json();

        // You can increase this limit any time
        foreach (array_slice($exchanges, 0, 5) as $ex) {

            $tvOverrides = [
                'gdax' => 'COINBASE',
                // Add more overrides as needed
            ];

            $tvPrefix = $tvOverrides[$ex['id']] ?? strtoupper($ex['id']);

            $exchange = Exchange::updateOrCreate(
                ['coingecko_id' => $ex['id']],
                [
                    'name'      => $ex['name'],
                    'country'   => $ex['country'] ?? null,
                    'url'       => $ex['url'] ?? null,
                    'tv_prefix' => $tvPrefix,
                ]
            );

            $this->info("✅ Synced exchange: {$exchange->name}");

            if (!$exchange->id) {
                $this->error("❌ Exchange ID is null for {$exchange->name}");
                continue;
            }

            $storedCount = 0;
            // foreach (TradingPair::all() as $t) {
            //         $t->delete();
            //     }
            foreach ($this->desciSymbols as $base) {
                $base = strtoupper(trim($base));
                $quote = 'USDT';

                // sanity checks
                if (!preg_match('/^[A-Z0-9]{2,10}$/', $base)) {
                    $this->warn("⚠️ Skipping invalid symbol: {$base}");
                    continue;
                }

                $tvSymbol = $exchange->tv_prefix . ':' . $base . $quote;
                try {
                    TradingPair::updateOrCreate(
                        [
                            'exchange_id' => $exchange->id,
                            'base_asset'  => $base,
                            'quote_asset' => $quote,
                        ],
                        [
                            'tv_symbol' => $tvSymbol,
                        ]
                    );

                    $storedCount++;
                } catch (\Exception $e) {
                    $this->error("❌ Failed to save {$base}/{$quote} for {$exchange->name}: " . $e->getMessage());
                }
            }

            $this->info("🔁 Stored {$storedCount} DeSci USDT pairs for: {$exchange->name}");
        }

        $this->info("🎉 DeSci sync complete!");
    }
}
