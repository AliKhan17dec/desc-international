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
        Schema::create('coin_launchpad_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coin_launchpad_id');

            $table->unsignedInteger('sort_order')->default(0);

            $table->enum('type', [
                'research_focus',
                'recommended_read',
                'value_model',
                'custom',
            ])->default('custom');

            $table->string('title')->nullable();
            $table->longText('body_text')->nullable(); // markdown / rich text
            $table->string('image_path')->nullable();  // stored file path
            $table->string('external_link')->nullable();

            $table->timestamps();

            $table->foreign('coin_launchpad_id')
                ->references('id')->on('coin_launchpads')
                ->cascadeOnDelete();

            $table->index(['coin_launchpad_id', 'sort_order']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_launchpad_blocks');
    }
};
