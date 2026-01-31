<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Sale;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSales extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Penjualan Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Sale::query()->with(['customer', 'seller'])->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('sale_number')
                    ->label('No. Sale')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->limit(15),
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
                    ->label('Total'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Sale $record): string => route('filament.admin.resources.sales.view', $record))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated(false);
    }
}
