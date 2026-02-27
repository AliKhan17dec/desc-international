<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coin_chain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coin_id')->constrained('coins')->cascadeOnDelete();
            $table->foreignId('chain_id')->constrained('chains')->cascadeOnDelete();

            $table->unique(['coin_id', 'chain_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coin_chain');
    }
};

