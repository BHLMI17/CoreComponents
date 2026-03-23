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

        // 2. Fix unique constraints
        // The previous migration might have a unique(['user_id', 'product_id']) which fails for guests
        Schema::table('baskets', function (Blueprint $table) {
            $indexes = Schema::getIndexes('baskets');
            $hasUnique = false;
            foreach ($indexes as $index) {
                if ($index['name'] === 'baskets_user_id_product_id_unique') {
                    $hasUnique = true;
                    break;
                }
            }

            if ($hasUnique) {
                $table->dropUnique(['user_id', 'product_id']);
            }
        });
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
