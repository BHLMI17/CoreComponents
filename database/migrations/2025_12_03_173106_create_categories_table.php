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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->mediumText('description');
            $table->string('slug');
            $table->string('status');
            $table->boolean('popular');
            $table->string('image');
            $table->string('meta_title');
            $table->mediumText('meta_description');
            $table->mediumText('meta_keyword');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
