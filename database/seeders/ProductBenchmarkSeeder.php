<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBenchmarkSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->where('id', 27)->update(['benchmark_score' => 28500]);
        DB::table('products')->where('id', 28)->update(['benchmark_score' => 39000]);
        DB::table('products')->where('id', 29)->update(['benchmark_score' => 49000]);
        DB::table('products')->where('id', 30)->update(['benchmark_score' => 19000]);
        DB::table('products')->where('id', 31)->update(['benchmark_score' => 22500]);
        DB::table('products')->where('id', 32)->update(['benchmark_score' => 14000]);
        DB::table('products')->where('id', 36)->update(['benchmark_score' => 15500]);
        DB::table('products')->where('id', 37)->update(['benchmark_score' => 22000]);
        DB::table('products')->where('id', 38)->update(['benchmark_score' => 28000]);
        DB::table('products')->where('id', 39)->update(['benchmark_score' => 38500]);
    }
}