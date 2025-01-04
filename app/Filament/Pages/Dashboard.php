<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FollowTodayOverview;
use App\Filament\Widgets\FollowupToday;
use Filament\Pages\Page;
use Filament\Panel;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';
}
