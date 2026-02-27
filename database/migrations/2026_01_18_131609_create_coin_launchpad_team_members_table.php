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
        Schema::create('coin_launchpad_team_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coin_launchpad_id');

            $table->string('name');
            $table->string('image')->nullable();
            $table->string('role')->nullable();       // Founder, Research Lead, etc.
            $table->string('external_url')->nullable(); // twitter/linkedin/etc
            $table->unsignedInteger('sort_order')->default(0);

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
        Schema::dropIfExists('coin_launchpad_team_members');
    }
};
