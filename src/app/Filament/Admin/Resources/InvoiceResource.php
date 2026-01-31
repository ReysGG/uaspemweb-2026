<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?string $recordTitleAttribute = 'invoice_number';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $unpaid = static::getModel()::whereIn('status', ['draft', 'sent'])->count();
        return $unpaid > 0 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Information')
                    ->schema([
                        Forms\Components\TextInput::make('invoice_number')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Select::make('sale_id')
                            ->relationship('sale', 'sale_number')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->disabled(),
                        Forms\Components\DatePicker::make('issue_date')
                            ->required()
                            ->default(now()),
                        Forms\Components\DatePicker::make('due_date')
                            ->required()
                            ->default(now()->addDays(30)),
                        Forms\Components\Select::make('status')
                            ->options(Invoice::STATUSES)
                            ->default('draft')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale.sale_number')
                    ->label('Sale')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale.customer.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sale.total')
                    ->label('Amount')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'sent',
                        'success' => 'paid',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Invoice::STATUSES),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('markAsSent')
                    ->label('Mark as Sent')
                    ->icon('heroicon-o-paper-airplane')
                    ->visible(fn (Invoice $record) => $record->status === 'draft')
                    ->action(fn (Invoice $record) => $record->update(['status' => 'sent']))
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('markAsPaid')
                    ->label('Mark as Paid')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (Invoice $record) => $record->status === 'sent')
                    ->action(fn (Invoice $record) => $record->update(['status' => 'paid']))
                    ->requiresConfirmation()
                    ->color('success'),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
