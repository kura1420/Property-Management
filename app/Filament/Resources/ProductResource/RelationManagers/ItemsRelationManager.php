<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(10),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(10),

                Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->maxLength(10),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp'),

                        Forms\Components\Select::make('status')
                            ->options([
                                0 => 'Waiting',
                                1 => 'Sold Out',
                                2 => 'Process',
                                3 => 'Hold',
                                4 => 'Cancel',
                                5 => 'Reject',
                            ])
                            ->required(),
                    ]),

                Forms\Components\FileUpload::make('foto')
                    ->directory('product/item')
                    ->image()
                    ->maxSize(2048)
                    ->openable()
                    ->downloadable()
                    ->previewable(false)
                    ->default(null)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('code'),

                Tables\Columns\TextColumn::make('name'),

                Tables\Columns\TextColumn::make('price')
                    ->money('Rp.')
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->numeric(),

                Tables\Columns\TextColumn::make('status'),
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
