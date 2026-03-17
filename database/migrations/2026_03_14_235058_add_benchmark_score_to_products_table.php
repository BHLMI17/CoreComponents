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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('benchmark_score')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('benchmark_score');
    });
}
};
