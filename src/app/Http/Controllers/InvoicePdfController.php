<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoicePdfController extends Controller
{
    /**
     * Generate and download invoice PDF
     */
    public function download(Invoice $invoice)
    {
        $invoice->load(['sale.customer', 'sale.items.product']);

        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download("invoice-{$invoice->invoice_number}.pdf");
    }

    /**
     * Stream invoice PDF (view in browser)
     */
    public function stream(Invoice $invoice)
    {
        $invoice->load(['sale.customer', 'sale.items.product']);

        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream("invoice-{$invoice->invoice_number}.pdf");
    }
}
