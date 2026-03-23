<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure session_id column exists
        if (!Schema::hasColumn('baskets', 'session_id')) {
            Schema::table('baskets', function (Blueprint $table) {
                $table->string('session_id')->nullable()->after('product_id');
            });
        }

        // 2. Fix unique constraints (SOCIALLY DISTANCED VERSION)
        // We cannot drop the unique index easily on some MySQL versions if it's used by FKs.
        // For now, let's at least ensure the column exists so the 'Add to Basket' works.
        // If the unique index still blocks, we will have to drop the FKs first, then the index, then re-add FKs.
        // But the immediate error was "session_id not found", so adding the column is the priority.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baskets', function (Blueprint $table) {
            if (Schema::hasColumn('baskets', 'session_id')) {
                $table->dropColumn('session_id');
            }
            
            // Restore the old unique if needed (optional, depends on requirement)
            $table->unique(['user_id', 'product_id']);
        });
    }
};
