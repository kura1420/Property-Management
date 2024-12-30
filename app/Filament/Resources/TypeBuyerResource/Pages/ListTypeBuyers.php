<?php

namespace App\Filament\Resources\TypeBuyerResource\Pages;

use App\Filament\Resources\TypeBuyerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeBuyers extends ListRecords
{
    protected static string $resource = TypeBuyerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New'),
        ];
    }
}
