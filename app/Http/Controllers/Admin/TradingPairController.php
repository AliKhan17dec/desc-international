<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TradingPair;

class TradingPairController extends Controller
{
    // public function index()
    // {
    //     $pairs = TradingPair::with('exchange')->groupBy('base_asset')->groupLimit(1,'base_asset')->get();
    //     return view('admin.pages.pairs.index', compact('pairs'));
    // }

    public function index()
    {
        $subQuery = TradingPair::select(DB::raw('MIN(id) as id'))
            ->groupBy('base_asset');

        $pairs = TradingPair::with('exchange')
            ->whereIn('id', $subQuery)
            ->get();

        return view('admin.pages.pairs.index', compact('pairs'));
    }
}