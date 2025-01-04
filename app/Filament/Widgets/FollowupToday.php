<?php

namespace App\Filament\Widgets;

use App\Models\SushiFollowupToday;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class FollowupToday extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(SushiFollowupToday::query())
            ->columns([
                TextColumn::make('role')
                    ->sortable(),

                TextColumn::make('fullname')
                    ->searchable(),

                TextColumn::make('handphone_1')
                    ->searchable()
                    ->formatStateUsing(fn($record): HtmlString => new HtmlString('<a href="https://wa.me/' . urlencode($record->handphone_1) . '?text=I%20interested%20in%20your%20car%20for%20sale" target="_blank">' . $record->handphone_1 . '</a>')),

                TextColumn::make('handphone_2')
                    ->searchable(),
            ]);
    }
}
