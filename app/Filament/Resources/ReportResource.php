<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel = 'Report';

    protected static ?string $breadcrumb = 'Report';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(\App\Models\Product::orderBy('name', 'asc')->get()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->live(),

                Forms\Components\Select::make('product_item_id')
                    ->label('Item')
                    ->options(
                        fn(Get $get): Collection => \App\Models\ProductItem::query()
                            ->where('product_id', $get('product_id'))
                            ->pluck('name', 'id')
                    )
                    ->nullable(),

                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->options(\App\Models\Customer::orderBy('fullname', 'asc')->get()->pluck('fullname', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        0 => 'Waiting',
                        1 => 'Done',
                        2 => 'Process',
                        3 => 'Hold',
                        4 => 'Cancel',
                        5 => 'Reject',
                    ])
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer.fullname')
                    ->label('Customer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),

                // Tables\Columns\IconColumn::make('status')
                //     ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
