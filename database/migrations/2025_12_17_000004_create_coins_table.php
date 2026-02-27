<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('symbol')->unique();      // UNIQUE: user entered, always uppercase
            $table->string('slug')->unique();

            $table->foreignId('coin_type_id')->constrained('coin_types')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->string('logo')->nullable();      // stored path
            $table->text('description')->nullable();

            // toggles for markets page sections
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_trending')->default(false);
            $table->unsignedInteger('trending_rank')->nullable(); // optional manual ordering
            $table->boolean('show_in_gainers')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};

