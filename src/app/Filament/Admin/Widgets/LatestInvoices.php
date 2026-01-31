<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Invoice;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestInvoices extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Invoice Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invoice::query()->with(['sale.customer'])->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('No. Invoice')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sale.customer.name')
                    ->label('Customer')
                    ->limit(15),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'sent',
                        'success' => 'paid',
                    ]),
                Tables\Columns\TextColumn::make('sale.total')
                    ->money('IDR')
                    ->label('Amount'),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo')
                    ->date('d/m/Y')
                    ->color(fn (Invoice $record) => $record->due_date < now() && $record->status !== 'paid' ? 'danger' : null),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Invoice $record): string => route('filament.admin.resources.invoices.view', $record))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated(false);
    }
}
