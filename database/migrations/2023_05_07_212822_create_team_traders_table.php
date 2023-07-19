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
        Schema::create('team_traders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreignUuid('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('content')->nullable();
            $table->double('share');
            $table->string('profits')->default(0);
            $table->string('harvestable')->default(0);
            $table->string('harvested')->default(0);
            $table->unsignedSmallInteger('priority')->nullable();
            $table->string('aum_amount')->nullable();
            $table->string('aum_currency')->nullable();
            $table->boolean('is_hireable')->default(false);
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('type')->default(13000);
            $table->unsignedSmallInteger('status')->default(13500);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_traders');
    }
};
