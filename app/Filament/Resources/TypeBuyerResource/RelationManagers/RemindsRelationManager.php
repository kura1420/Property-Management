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
                Forms\Components\TextInput::make('seq')
                    ->label('Sequence')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('step')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('descr')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('step')
            ->columns([
                Tables\Columns\TextColumn::make('seq')
                    ->sortable(),

                Tables\Columns\TextColumn::make('step')
                    ->description(fn(RemindBuyer $record): string => $record->descr),

                // Tables\Columns\TextColumn::make('descr')
                //     ->description(fn(Post $record): string => $record->description),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
