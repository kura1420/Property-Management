<?php

namespace App\Filament\Resources\TypeBuyerResource\Pages;

use App\Filament\Resources\TypeBuyerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeBuyer extends EditRecord
{
    protected static string $resource = TypeBuyerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
