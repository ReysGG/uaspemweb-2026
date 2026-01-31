<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function stats(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        // Total Sales
        $totalSales = Sale::whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');

        // Sales Count by Status
        $salesByStatus = Sale::select('status', DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('status')
            ->pluck('count', 'status');

        // New Customers
        $newCustomers = Customer::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Pending Invoices
        $pendingInvoices = Invoice::whereIn('status', ['draft', 'sent'])
            ->sum(DB::raw('(SELECT total FROM sales WHERE sales.id = invoices.sale_id)'));

        // Top Products
        $topProducts = Product::select('products.id', 'products.name', DB::raw('SUM(sale_items.quantity) as total_sold'))
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Monthly Sales Trend
        $monthlySales = Sale::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'total_sales' => $totalSales,
                'sales_by_status' => $salesByStatus,
                'new_customers' => $newCustomers,
                'pending_invoices' => $pendingInvoices,
                'top_products' => $topProducts,
                'monthly_trend' => $monthlySales,
                'period' => [
                    'start' => $startDate,
                    'end' => $endDate,
                ],
            ],
        ]);
    }
}
