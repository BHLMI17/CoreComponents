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
        Schema::table('baskets', function (Blueprint $table) {
            // Only drop columns if they exist (safe for all environments)
            if (Schema::hasColumn('baskets', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('baskets', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('baskets', 'image')) {
                $table->dropColumn('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baskets', function (Blueprint $table) {
            // Restore columns if rollback happens
            if (!Schema::hasColumn('baskets', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('baskets', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('baskets', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }
};