<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class orderStats extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->description('All orders in the system')
                ->descriptionIcon('heroicon-o-shopping-cart', IconPosition::Before)
                ->color('primary')
                ->chart([5, 12, Order::count()]),
        ];
    }
}
