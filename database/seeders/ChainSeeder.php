<?php

namespace Database\Seeders;

use App\Models\Chain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChainSeeder extends Seeder
{
    public function run(): void
    {
        $chains = [
            ['name' => 'Ethereum', 'symbol' => 'ETH'],
            ['name' => 'Base',     'symbol' => 'BASE'],
            ['name' => 'Solana',   'symbol' => 'SOL'],
            ['name' => 'Arbitrum', 'symbol' => 'ARB'],
        ];

        foreach ($chains as $c) {
            Chain::updateOrCreate(
                ['name' => $c['name']],
                [
                    'slug' => Str::slug($c['name']),
                    'symbol' => $c['symbol'],
                    'is_active' => true
                ]
            );
        }
    }
}

