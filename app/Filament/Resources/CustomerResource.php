<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?string $breadcrumb = 'Customer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('greeting')
                    ->options([
                        'Bapak.' => 'Bapak.',
                        'Ibu.' => 'Ibu.',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nickname')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('handphone_1')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('handphone_2')
                    ->tel()
                    ->maxLength(20)
                    ->default(null),

                Forms\Components\Textarea::make('notes')
                    ->rows(3)
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('greeting')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nickname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('handphone_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('handphone_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
