<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SaleResource\Pages;
use App\Models\Sale;
use App\Models\SaleStatusHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?string $recordTitleAttribute = 'sale_number';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $pending = static::getModel()::where('status', '!=', 'completed')->count();
        return $pending > 0 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sale Information')
                    ->schema([
                        Forms\Components\TextInput::make('sale_number')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Auto-generated'),
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('company'),
                                Forms\Components\TextInput::make('email')->email(),
                                Forms\Components\TextInput::make('phone'),
                            ]),
                        Forms\Components\Select::make('seller_id')
                            ->relationship('seller', 'name')
                            ->default(fn () => Auth::id())
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status')
                            ->options(Sale::STATUSES)
                            ->default('quotation')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $product = \App\Models\Product::find($state);
                                            $set('unit_price', $product?->price ?? 0);
                                        }
                                    })
                                    ->columnSpan(3),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $set('total_price', $state * $get('unit_price'));
                                    })
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('unit_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $set('total_price', $get('quantity') * $state);
                                    })
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('total_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->disabled()
                                    ->dehydrated(true)
                                    ->columnSpan(2),
                            ])
                            ->columns(8)
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->collapsible(),
                    ]),

                Forms\Components\Section::make('Totals & Notes')
                    ->schema([
                        Forms\Components\TextInput::make('tax_rate')
                            ->numeric()
                            ->suffix('%')
                            ->default(11)
                            ->helperText('PPN rate'),
                        Forms\Components\DatePicker::make('eta')
                            ->label('Estimated Arrival'),
                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('seller.name')
                    ->label('Salesperson')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'quotation',
                        'info' => 'confirmed',
                        'warning' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'completed',
                    ]),
                Tables\Columns\TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('eta')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Sale::STATUSES),
                Tables\Filters\SelectFilter::make('seller')
                    ->relationship('seller', 'name'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('updateStatus')
                        ->label('Update Status')
                        ->icon('heroicon-o-arrow-path')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->options(Sale::STATUSES)
                                ->required(),
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes')
                                ->rows(2),
                        ])
                        ->action(function (Sale $record, array $data) {
                            $oldStatus = $record->status;
                            $record->update(['status' => $data['status']]);
                            
                            SaleStatusHistory::create([
                                'sale_id' => $record->id,
                                'from_status' => $oldStatus,
                                'to_status' => $data['status'],
                                'changed_by' => Auth::id(),
                                'notes' => $data['notes'] ?? null,
                            ]);
                        }),
                    Tables\Actions\Action::make('generateInvoice')
                        ->label('Generate Invoice')
                        ->icon('heroicon-o-document-text')
                        ->visible(fn (Sale $record) => !$record->invoice()->exists())
                        ->action(function (Sale $record) {
                            $record->invoice()->create([
                                'issue_date' => now(),
                                'due_date' => now()->addDays(30),
                            ]);
                        })
                        ->successNotificationTitle('Invoice generated successfully'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
