<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalSales = Sale::sum('total');
        $monthlySales = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');
        
        $pendingSales = Sale::whereNotIn('status', ['completed'])->count();
        $completedSales = Sale::where('status', 'completed')->count();
        
        $unpaidInvoices = Invoice::whereIn('status', ['draft', 'sent'])->count();
        $paidInvoices = Invoice::where('status', 'paid')->count();

        return [
            Stat::make('Total Penjualan', 'Rp ' . number_format($totalSales, 0, ',', '.'))
                ->description('Sepanjang waktu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format($monthlySales, 0, ',', '.'))
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Sales Pending', $pendingSales)
                ->description($completedSales . ' completed')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Invoice Belum Dibayar', $unpaidInvoices)
                ->description($paidInvoices . ' sudah dibayar')
                ->descriptionIcon('heroicon-m-document-text')
                ->color($unpaidInvoices > 0 ? 'danger' : 'success'),

            Stat::make('Total Produk', Product::count())
                ->description(Product::where('is_active', true)->count() . ' aktif')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),

            Stat::make('Total Customer', Customer::count())
                ->description(Customer::where('is_active', true)->count() . ' aktif')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('gray'),
        ];
    }
}
