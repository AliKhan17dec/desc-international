<?php

namespace App\Http\Controllers;

use App\Models\CoinLaunchpad;

class CoinLaunchpadPublicController extends Controller
{
    public function show(string $slug)
    {
        // 1) Try by launchpad slug
        $launchpad = CoinLaunchpad::query()
            ->where('slug', $slug)
            ->with(['coin', 'category', 'blocks', 'teamMembers', 'externalLinks'])
            ->first();

        // 2) Fallback: if user passes coin slug (if you have coins.slug)
        if (! $launchpad) {
            $launchpad = CoinLaunchpad::query()
                ->whereHas('coin', fn ($q) => $q->where('slug', $slug))
                ->with(['coin', 'category', 'blocks', 'teamMembers', 'externalLinks'])
                ->firstOrFail();
        }

        // Split blocks by type for cleaner rendering
        $researchBlocks = $launchpad->blocks->where('type', 'research_focus')->values();
        $recommendedReads = $launchpad->blocks->where('type', 'recommended_read')->values();
        $valueModelBlocks = $launchpad->blocks->where('type', 'value_model')->values();
        $customBlocks = $launchpad->blocks->where('type', 'custom')->values();

        return view('web.pages.coin_launchpad.show', compact(
            'launchpad',
            'researchBlocks',
            'recommendedReads',
            'valueModelBlocks',
            'customBlocks'
        ));
    }
}
