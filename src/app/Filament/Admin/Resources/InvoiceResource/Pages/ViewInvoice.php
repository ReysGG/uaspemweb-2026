<?php

namespace App\Filament\Admin\Resources\InvoiceResource\Pages;

use App\Filament\Admin\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->url(fn () => route('invoice.download', $this->record))
                ->openUrlInNewTab(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Invoice Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('invoice_number'),
                        Infolists\Components\TextEntry::make('sale.sale_number')
                            ->label('Sale Reference'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'draft' => 'gray',
                                'sent' => 'warning',
                                'paid' => 'success',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('issue_date')
                            ->date(),
                        Infolists\Components\TextEntry::make('due_date')
                            ->date(),
                    ])->columns(3),

                Infolists\Components\Section::make('Customer')
                    ->schema([
                        Infolists\Components\TextEntry::make('sale.customer.name'),
                        Infolists\Components\TextEntry::make('sale.customer.company'),
                        Infolists\Components\TextEntry::make('sale.customer.email'),
                        Infolists\Components\TextEntry::make('sale.customer.address')
                            ->columnSpanFull(),
                    ])->columns(3),

                Infolists\Components\Section::make('Items')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('sale.items')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('product.name'),
                                Infolists\Components\TextEntry::make('quantity'),
                                Infolists\Components\TextEntry::make('unit_price')
                                    ->money('IDR'),
                                Infolists\Components\TextEntry::make('total_price')
                                    ->money('IDR'),
                            ])->columns(4),
                    ]),

                Infolists\Components\Section::make('Totals')
                    ->schema([
                        Infolists\Components\TextEntry::make('sale.subtotal')
                            ->label('Subtotal')
                            ->money('IDR'),
                        Infolists\Components\TextEntry::make('sale.tax_rate')
                            ->label('Tax Rate')
                            ->suffix('%'),
                        Infolists\Components\TextEntry::make('sale.tax_amount')
                            ->label('Tax Amount')
                            ->money('IDR'),
                        Infolists\Components\TextEntry::make('sale.total')
                            ->label('Total')
                            ->money('IDR')
                            ->weight('bold'),
                    ])->columns(4),
            ]);
    }
}
