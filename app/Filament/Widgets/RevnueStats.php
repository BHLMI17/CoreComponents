<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\OrderItem;

class RevnueStats extends StatsOverviewWidget
{

    protected function getStats(): array
    {

        $totalRevenue = OrderItem::sum('price');

        return [
            Stat::make('Total Revenue', '£' . number_format($totalRevenue, 2))
                ->description('All-time revenue')
                ->color('success'),
        ];
    }
}
