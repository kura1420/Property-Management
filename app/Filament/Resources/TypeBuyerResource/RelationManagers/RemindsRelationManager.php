<?php

namespace App\Filament\Resources\TypeBuyerResource\RelationManagers;

use App\Models\RemindBuyer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RemindsRelationManager extends RelationManager
{
    protected static string $relationship = 'reminds';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'D' => 'Day',
                        'W' => 'Week',
                        // 'M' => 'Month',
                        // 'Y' => 'Year',
                    ]),

                Forms\Components\TextInput::make('remind')
                    ->label('Remind')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('descr')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('step')
            ->heading('List')
            ->columns([
                Tables\Columns\TextColumn::make('remindHPlus')
                    ->label('Remind')
                    ->description(fn(RemindBuyer $record): string => $record->descr),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
