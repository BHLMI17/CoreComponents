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

        // 2. Fix unique constraints safely
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            Schema::table('baskets', function (Blueprint $table) {
                $uniqueIndex = 'baskets_user_id_product_id_unique';
                $indexes = Schema::getIndexes('baskets');
                
                $exists = false;
                foreach ($indexes as $index) {
                    if ($index['name'] === $uniqueIndex) {
                        $exists = true;
                        break;
                    }
                }
                
                if ($exists) {
                    $table->dropUnique($uniqueIndex);
                }
            });

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            \Illuminate\Support\Facades\Log::warning('Could not drop unique index on baskets: ' . $e->getMessage());
        }
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
