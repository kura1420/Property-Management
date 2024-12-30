<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?string $breadcrumb = 'Customer';

    protected static ?string $navigationGroup = 'Database';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Forms\Components\Select::make('greeting')
                            ->options([
                                'Bapak.' => 'Bapak.',
                                'Ibu.' => 'Ibu.',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('nickname')
                            ->helperText('Nama Panggilan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('fullname')
                            ->required()
                            ->maxLength(255),
                    ]),

                Grid::make(4)
                    ->schema([
                        Forms\Components\Select::make('lead_id')
                            ->label('Lead')
                            ->options(\App\Models\Lead::orderBy('name', 'asc')->get()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('type_buyer_id')
                            ->label('Type Buyer')
                            ->options(\App\Models\TypeBuyer::orderBy('name', 'asc')->get()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('handphone_1')
                            ->tel()
                            ->helperText('Yang terhubung ke Whatsapp, angka 0 di depan jadikan 62')
                            ->required()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('handphone_2')
                            ->tel()
                            ->maxLength(20)
                            ->default(null),
                    ]),

                Grid::make(12)
                    ->schema([
                        Forms\Components\DatePicker::make('first_res_date')
                            ->label('Tgl. Pertama Respond')
                            ->columnSpan(3)
                            ->required(),

                        Forms\Components\TextInput::make('domisili')
                            ->columnSpan(9)
                            ->maxLength(255)
                            ->required()
                            ->default(null),
                    ]),


                Forms\Components\RichEditor::make('notes')
                    ->label('Note')
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\RichEditor::make('request_note')
                    ->label('Note Request')
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\RichEditor::make('cost_plan')
                    ->label('Cost Plan')
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable(),


                Tables\Columns\TextColumn::make('handphone_1')
                    ->action(fn($record) => null)
                    ->formatStateUsing(fn($record): HtmlString => new HtmlString('<a href="https://wa.me/' . urlencode($record->handphone_1) . '?text=I%20interested%20in%20your%20car%20for%20sale" target="_blank">' . $record->handphone_1 . '</a>')),

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
