<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Get all sales (paginated)
     */
    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'seller', 'items.product']);

        // Filter by customer for pembeli role
        if (Auth::user()->hasRole('pembeli')) {
            $customer = Auth::user()->customer;
            if ($customer) {
                $query->where('customer_id', $customer->id);
            } else {
                return response()->json(['success' => true, 'data' => []]);
            }
        }

        // Filter by seller for penjual role
        if (Auth::user()->hasRole('penjual')) {
            $query->where('seller_id', Auth::id());
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $sales = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $sales,
        ]);
    }

    /**
     * Get single sale
     */
    public function show($id)
    {
        $sale = Sale::with(['customer', 'seller', 'items.product', 'invoice', 'statusHistories.changedByUser'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $sale,
        ]);
    }

    /**
     * Get sale tracking history
     */
    public function tracking($id)
    {
        $sale = Sale::with('statusHistories.changedByUser')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'sale_number' => $sale->sale_number,
                'current_status' => $sale->status,
                'history' => $sale->statusHistories,
            ],
        ]);
    }

    /**
     * Update sale status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:quotation,confirmed,processing,shipped,completed',
            'notes' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($id);
        $oldStatus = $sale->status;

        $sale->update(['status' => $request->status]);

        SaleStatusHistory::create([
            'sale_id' => $sale->id,
            'from_status' => $oldStatus,
            'to_status' => $request->status,
            'changed_by' => Auth::id(),
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $sale->fresh(),
        ]);
    }
}
