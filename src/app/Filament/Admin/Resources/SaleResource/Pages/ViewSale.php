<?php

namespace App\Filament\Admin\Resources\SaleResource\Pages;

use App\Filament\Admin\Resources\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewSale extends ViewRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Sale Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('sale_number'),
                        Infolists\Components\TextEntry::make('customer.name'),
                        Infolists\Components\TextEntry::make('seller.name')
                            ->label('Salesperson'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'quotation' => 'gray',
                                'confirmed' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'primary',
                                'completed' => 'success',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('eta')
                            ->date(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->dateTime(),
                    ])->columns(3),

                Infolists\Components\Section::make('Totals')
                    ->schema([
                        Infolists\Components\TextEntry::make('subtotal')
                            ->money('IDR'),
                        Infolists\Components\TextEntry::make('tax_rate')
                            ->suffix('%'),
                        Infolists\Components\TextEntry::make('tax_amount')
                            ->money('IDR'),
                        Infolists\Components\TextEntry::make('total')
                            ->money('IDR')
                            ->weight('bold'),
                    ])->columns(4),

                Infolists\Components\Section::make('Notes')
                    ->schema([
                        Infolists\Components\TextEntry::make('notes')
                            ->columnSpanFull(),
                    ])->collapsed(),

                Infolists\Components\Section::make('Status History')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('statusHistories')
                            ->schema([
                                Infolists\Components\TextEntry::make('from_status')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('to_status')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('changedByUser.name')
                                    ->label('Changed By'),
                                Infolists\Components\TextEntry::make('created_at')
                                    ->dateTime(),
                                Infolists\Components\TextEntry::make('notes'),
                            ])->columns(5),
                    ])->collapsed(),
            ]);
    }
}
