<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coin_launchpads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('coin_id');
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('slug')->unique(); // public URL key (hairdao, etc.)

            $table->enum('status', ['live', 'upcoming'])->default('live');

            $table->longText('summary_text')->nullable();

            $table->json('phase_steps')->nullable()
                ->comment('JSON array: [{ step_name: string, done: bool }]');

            $table->json('highlight_stats')->nullable()
                ->comment('JSON array: [{ label: string, value: string }]');

            $table->longText('value_capture_text')->nullable()
                ->comment('rich markdown text');

            $table->timestamps();

            $table->foreign('coin_id')->references('id')->on('coins')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

            // If you want exactly one launchpad record per coin:
            $table->unique('coin_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_launchpads');
    }
};
