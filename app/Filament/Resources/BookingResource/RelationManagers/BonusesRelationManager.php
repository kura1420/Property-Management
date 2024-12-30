<?php

namespace App\Filament\Resources\BookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BonusesRelationManager extends RelationManager
{
    protected static string $relationship = 'bonuses';

    protected static ?string $title = 'Bonus';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bonus_id')
                    ->label('Bonus')
                    ->options(\App\Models\Bonus::orderBy('name', 'asc')->get()->pluck('name', 'id'))
                    ->multiple()
                    ->searchable()
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bonus_id')
            ->heading('List')
            ->columns([
                Tables\Columns\TextColumn::make('bonus.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New')
                    ->using(function (array $data, string $model): Model {
                        $m = null;

                        foreach ($data['bonus_id'] as $d) {
                            $m = $model::create([
                                'booking_id' => $this->getOwnerRecord()->getKey(),
                                'bonus_id' => $d,
                            ]);
                        }

                        return $m;
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
