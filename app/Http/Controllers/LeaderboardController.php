<?php

namespace App\Http\Controllers;

use App\Models\CopyTrader;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Fetch top traders based on PNL or ROI
        // Assuming PNL is the main metric for the leaderboard
        $traders = CopyTrader::orderBy('pnl', 'desc')
            ->take(20)
            ->get()
            ->map(function ($trader, $index) {
                return [
                    'rank' => $index + 1,
                    'name' => $trader->name,
                    'username' => $trader->username,
                    'pnl' => number_format($trader->pnl, 2),
                    'rewards' => number_format($trader->profit_sharing, 2), // Assuming profit_sharing as rewards or just a placeholder
                    'roi' => $trader->roi,
                    'color' => $this->getAvatarColor($index),
                    'avatar_initial' => substr($trader->name, 0, 1)
                ];
            });

        return response()->json([
            'data' => $traders
        ]);
    }

    private function getAvatarColor($index)
    {
        $colors = ['#ff4d4f', '#666', '#4d7c0f', '#333', '#059669', '#ca8a04', '#475569', '#111'];
        return $colors[$index % count($colors)];
    }
}
