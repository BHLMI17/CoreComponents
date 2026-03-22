<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStockStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {

        return Product::orderBy('stock', 'asc')
        ->take(3)
        ->get()
        ->map(function ($product) {
            return Stat::make($product->name, $product->stock)
                ->description('Units left')
                ->color($product->stock < 5 ? 'danger' : 'warning');
        })
        ->toArray();
    }
}
