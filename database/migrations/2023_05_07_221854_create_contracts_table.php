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
        Schema::create('contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreignUuid('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('team_trader_id')->constrained('team_traders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('desk_id')->constrained('desks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('desk_account_id')->constrained('desk_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('number')->unique();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->double('share');
            $table->string('start_balance');
            $table->string('current_balance');
            $table->string('currency')->default('USD');
            $table->string('profits')->default(0);
            $table->string('harvestable')->default(0);
            $table->string('harvested')->default(0);
            $table->string('scale_up_amount')->nullable();
            $table->unsignedTinyInteger('scaled_up_times')->default(0);
            $table->timestamp('scaled_up_at')->nullable();
            $table->double('target')->default(10);
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('status')->default(14000);
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
        Schema::dropIfExists('contracts');
    }
};
