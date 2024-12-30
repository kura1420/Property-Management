<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Booking';

    protected static ?string $breadcrumb = 'Booking';

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
                    ->required(),

                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->options(\App\Models\Customer::orderBy('fullname', 'asc')->get()->pluck('fullname', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->label('Agent')
                    ->options(\App\Models\User::orderBy('name', 'asc')->get()->pluck('name', 'id'))
                    ->required(),

                Grid::make(3)
                    ->schema([
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

                        Forms\Components\DatePicker::make('date')
                            ->required(),

                        Forms\Components\TextInput::make('down_payment')
                            ->required()
                            ->numeric()
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(','),
                    ]),

                Forms\Components\RichEditor::make('notes')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('productItem.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
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
            RelationManagers\BonusesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
