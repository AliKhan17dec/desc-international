<?php

namespace App\Http\Controllers;

use App\Models\AssetCoin;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function leaderboard()
    {
        return view('web.pages.UserDashboard.leaderboard');
    }

    public function contest()
    {
        return view('web.pages.UserDashboard.contest');
    }

    public function orders()
    {
        return view('web.pages.UserDashboard.orders');
    }

    public function performanceBonus()
    {
        return view('web.pages.UserDashboard.performance-bonus');
    }

    public function rewardsHub()
    {
        return view('web.pages.UserDashboard.rewards-hub');
    }

    public function account()
    {
        return view('web.pages.UserDashboard.account');
    }

    public function settings()
    {
        return view('web.pages.UserDashboard.settings');
    }

    public function support()
    {
        return view('web.pages.UserDashboard.support');
    }

    public function dashboard()
    {
        $wallets = Auth::user()->wallets;
        $holdings = $wallets->map(function ($wallet) {
            return [
                'coin' => $wallet->coin,
                'balance' => $wallet->balance,
            ];
        })->filter(function ($holding) {
            return $holding['balance'] > 0;
        });
        return view('web.pages.UserDashboard.dashboard', [
            'wallets' => $wallets,
            'holdings' => $holdings,
        ]);
    }

    public function deposit()
    {
        $assets = AssetCoin::where('is_active', true)->get();
        return view('web.pages.UserDashboard.deposit', [
            'assets' => $assets,
        ]);
    }

    public function assets()
    {
        $wallets = Auth::user()->wallets()->with('coin')->get();
        $assets = AssetCoin::where('is_active', true)->get();

        return view('web.pages.UserDashboard.assets', [
            'wallets' => $wallets,
            'assets' => $assets,
        ]);
    }

    public function withdrawls()
    {
        $coins = AssetCoin::where('is_active', true)->get();
        $withdrawls = Auth::user()->withdrawls()->with('coin')->get();
        // $wallets = Wallet::where('user_id', Auth::user()->id)->get();
        $wallets = auth()->user()->wallets()->pluck('balance', 'asset_coin_id')->toArray();
        return view('web.pages.UserDashboard.withdrawls', [
            'withdrawls' => $withdrawls,
            'wallets' => $wallets,
            'coins' => $coins,
        ]);
    }
}
