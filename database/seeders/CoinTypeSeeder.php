<?php

namespace Database\Seeders;

use App\Models\CoinType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoinTypeSeeder extends Seeder
{
    public function run(): void
    {
        $coinTypes = [
            ['name' => 'DAO', 'icon' => '<i class="fa-solid fa-gear"></i>'],
            ['name' => 'Agent', 'icon' => '<i class="fa-solid fa-people-group"></i>'],
            ['name' => 'IPT', 'icon' => '<i class="fa-solid fa-pen"></i>'],
        ];
        foreach ($coinTypes as $ct) {
            CoinType::updateOrCreate(
                ['name' => $ct['name']],
                ['slug' => Str::slug($ct['name']), 'is_active' => true, 'icon' => $ct['icon']]
            );
        }
    }
}

