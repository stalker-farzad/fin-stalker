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
        Schema::create('desk_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('desk_id')->constrained('desks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('trading_account_id')->index();
            $table->uuid('risk_management_id')->index();
            $table->uuid('money_management_id')->index();
            $table->string('title')->nullable();
            $table->uuid('user_id')->nullable();
            $table->unsignedSmallInteger('priority')->nullable();
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('type')->default(11000);
            $table->unsignedSmallInteger('status')->default(11500);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk_accounts');
    }
};
