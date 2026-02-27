<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();        // Ethereum
            $table->string('slug')->unique();        // ethereum
            $table->string('symbol')->unique();      // ETH (optional but useful)
            $table->string('icon')->nullable();      // stored path for icon image (png/svg)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chains');
    }
};

