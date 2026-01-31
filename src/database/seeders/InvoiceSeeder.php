<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sales that should have invoices (confirmed and above)
        $salesWithInvoices = Sale::whereIn('status', ['confirmed', 'processing', 'shipped', 'completed'])
            ->whereDoesntHave('invoice')
            ->get();

        if ($salesWithInvoices->isEmpty()) {
            $this->command->warn('No eligible sales found. Run SaleSeeder first.');
            return;
        }

        foreach ($salesWithInvoices as $sale) {
            $status = $this->getInvoiceStatus($sale->status);
            $issueDate = $sale->created_at->addDays(1);
            $dueDate = $issueDate->copy()->addDays(30);

            $invoice = Invoice::create([
                'sale_id' => $sale->id,
                'issue_date' => $issueDate,
                'due_date' => $dueDate,
                'status' => $status,
            ]);

            $this->command->info("Created Invoice #{$invoice->invoice_number} for Sale #{$sale->sale_number} - Status: {$status}");
        }

        $this->command->info('Invoices seeded successfully!');
    }

    private function getInvoiceStatus(string $saleStatus): string
    {
        return match ($saleStatus) {
            'completed' => 'paid',
            'shipped' => 'sent',
            'processing' => 'sent',
            'confirmed' => 'draft',
            default => 'draft',
        };
    }
}
