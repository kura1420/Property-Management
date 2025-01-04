<?php

namespace App\Filament\Widgets;

use App\Services\ReportService;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FollowTodayOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $_getTodayAndLate = ReportService::getTodayAndLate();

        $today = count($_getTodayAndLate['today']);
        $late = count($_getTodayAndLate['late']);

        return [
            //
            Stat::make('Followup Today', $today),

            Stat::make('FollowUp Late', $late),

            Stat::make('Total Customer', $today + $late),
        ];
    }
}
