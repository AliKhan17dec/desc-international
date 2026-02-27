<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your custom middleware aliases here
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        // High frequency financial updates
        $schedule->command('arbitrage:complete-subscriptions')->everyMinute();
        $schedule->command('arbitrage:process-intervals')->everyMinute();
        // Daily calculations & automation
        $schedule->command('profits:calculate-daily')->daily();
        $schedule->command('copy:process-auto-invest')->daily();
        // External Data Syncing (Low priority)
        $schedule->command('sync:crypto-currencies')->dailyAt('03:00');
        $schedule->command('sync:crypto-exchanges')->dailyAt('03:30');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
