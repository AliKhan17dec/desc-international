<?php

use App\Http\Controllers\Admin\ArbitrageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChainController;
use App\Http\Controllers\Admin\CoinController;
use App\Http\Controllers\Admin\CoinLaunchpadController;
use App\Http\Controllers\Admin\CoinTypeController;
use App\Http\Controllers\Admin\CopyTraderController as AdminCopyTraderController;
use App\Http\Controllers\Admin\CopyTraderPackageController;
use App\Http\Controllers\Admin\CopyTradingPackageController;
use App\Http\Controllers\Admin\DepositController as AdminDepositController;
use App\Http\Controllers\Admin\ExchangeController;
use App\Http\Controllers\Admin\TradingPairController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawalController as AdminWithdrawalController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ArbitrageSubscriptionController;
use App\Http\Controllers\CopyPortfolioController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCopyTraderController;
use App\Http\Controllers\WithdrawlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Vue SPA Routes
|--------------------------------------------------------------------------
*/

// Auth-protected Vue pages (Shell still renders via Vue Router)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/{any?}', function () { return view('app'); })->where('any', '.*')->name('user.dashboard');
    Route::get('/portfolio', function () { return view('app'); })->name('portfolio');
    Route::get('/deposit', function () { return view('app'); })->name('deposit');
    
    Route::get('/auth/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });

    // Backend actions (keep these for functionality)
    Route::post('/arbitrage-subscriptions', [ArbitrageSubscriptionController::class, 'store'])->name('arbitrage.subscription.store');
    Route::post('copy-trader/{id}/invest', [UserCopyTraderController::class, 'invest'])->name('web.copytrading.invest');
    Route::post('/deposit/submit', [DepositController::class, 'submit'])->name('user.deposit.submit');
    Route::post('/withdraw/submit', [WithdrawlController::class, 'submit'])->name('user.withdraw.submit');
    Route::post('/copy-trading/auto-invest/{auto}/cancel', [CopyPortfolioController::class, 'cancelAutoInvest'])->name('copy-auto-invest.cancel');
    Route::post('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.read');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return view('app'); })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Blade UI)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/copy-trading-packages', [CopyTradingPackageController::class, 'index'])->name('admin.copy-trading-packages.index');
        Route::post('/copy-trading-packages', [CopyTradingPackageController::class, 'store'])->name('admin.copy-trading-packages.store');
        Route::delete('/copy-trading-packages/{copyTradingPackage}', [CopyTradingPackageController::class, 'destroy'])->name('admin.copy-trading-packages.destroy');
        Route::post('/copy-traders/{copyTrader}/packages', [CopyTraderPackageController::class, 'store'])->name('admin.copy-traders.packages.store');
        Route::delete('/copy-traders/{copyTrader}/packages/{copyTraderPackage}', [CopyTraderPackageController::class, 'destroy'])->name('admin.copy-traders.packages.destroy');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/deposits', [AdminDepositController::class, 'index'])->name('admin.deposits');
        Route::get('/deposits/{id}', [AdminDepositController::class, 'show'])->name('admin.deposits.show');
        Route::post('/deposits/{id}/approve', [AdminDepositController::class, 'approve'])->name('admin.deposits.approve');
        Route::post('/deposits/{id}/reject', [AdminDepositController::class, 'reject'])->name('admin.deposits.reject');
        Route::get('/notifications/markAsRead', [AdminAuthController::class, 'markNotificationsAsRead'])->name('notifications.markAsRead');
        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
        Route::get('/exchanges', [ExchangeController::class, 'index'])->name('admin.exchanges.index');
        Route::get('/pairs', [TradingPairController::class, 'index'])->name('admin.pairs.index');
        Route::get('/arbitrage-bots/create', [ArbitrageController::class, 'create'])->name('admin.arbitrage.create');
        Route::get('/arbitrage-bots', [ArbitrageController::class, 'index'])->name('admin.arbitrage.index');
        Route::get('/arbitrage-bots/subscription', [ArbitrageController::class, 'subscriptions'])->name('admin.arbitrage.subscriptions');
        Route::post('/arbitrage-bots', [ArbitrageController::class, 'store'])->name('admin.arbitrage-bots.store');
        Route::get('/arbitrage-bots/{id}/configure', [ArbitrageController::class, 'configure'])->name('admin.arbitrage.configure');
        Route::post('/arbitrage-bots/{id}/save-fees', [ArbitrageController::class, 'saveFees'])->name('admin.arbitrage-bots.saveFees');
        Route::post('/arbitrage-bots/{id}/save-interval', [ArbitrageController::class, 'saveInterval'])->name('admin.arbitrage-bots.saveInterval');
        Route::resource('copy-traders', AdminCopyTraderController::class);
        Route::get('copy-traders/{copyTrader}/fee-profit-ranges/create', [AdminCopyTraderController::class, 'createFeeProfitRange'])->name('admin.copy-traders.create-fee-profit-range');
        Route::post('copy-traders/{copyTrader}/fee-profit-ranges', [AdminCopyTraderController::class, 'storeFeeProfitRange'])->name('admin.copy-traders.store-fee-profit-range');
        Route::delete('copy-traders/fee-profit-ranges/{feeProfit}', [AdminCopyTraderController::class, 'deleteFeeProfitRange'])->name('admin.copy-traders.delete-fee-profit-range');
        Route::get('/copy-trading/subscriptions', [\App\Http\Controllers\Admin\CopyTradeSubscriptionController::class, 'index'])->name('admin.copytrade-subscriptions.index');
        Route::resource('coin-types', CoinTypeController::class)->names('admin.coin-types');
        Route::resource('categories', CategoryController::class)->names('admin.categories');
        Route::resource('chains', ChainController::class)->names('admin.chains');
        Route::resource('coins', CoinController::class)->names('admin.coins');
        Route::name('admin.')->group(function () {
            Route::resource('coin-launchpads', CoinLaunchpadController::class);
        });
    });
});

Route::get('/leaderboard-json', [\App\Http\Controllers\LeaderboardController::class, 'index']);
Route::get('/csrf-cookie', function () {
    return response()->noContent();
});

/*
|--------------------------------------------------------------------------
| Catch-all for Vue Router
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('app');
})->name('spa.fallback');

require __DIR__ . '/auth.php';
