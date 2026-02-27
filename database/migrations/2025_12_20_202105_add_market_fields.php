<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->decimal('mindshare', 20, 6)->default(0);
            $table->decimal('volume_percentage_24h', 8, 4)->default(0);
            $table->string('marketcap')->default(0);
            $table->decimal('price', 8, 4)->default(0);
            $table->bigInteger('price_change')->default(0);
            $table->decimal('volume_24h', 8, 4)->default(0);
            $table->integer('holders')->default(0);
            $table->enum('marketcap_trend', ['up', 'down'])->default('up');
        });
    }

    public function down(): void
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn([
                'mindshare',
                'volume_percentage_24h',
                'marketcap',
                'price',
                'price_change',
                'volume_24h',
                'holders',
                'marketcap_trend',
            ]);
        });
    }
};
