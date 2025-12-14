<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->string('name')->after('product_id');
            $table->decimal('price', 8, 2)->after('name');
            $table->string('image')->nullable()->after('price');
        });
    }

    public function down()
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->dropColumn(['name', 'price', 'image']);
        });
    }
};
