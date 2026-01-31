<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleStatusHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();
        $sellers = User::role(['penjual', 'admin'])->get();

        if ($customers->isEmpty() || $products->isEmpty() || $sellers->isEmpty()) {
            $this->command->warn('Please run CustomerSeeder, ProductSeeder, and UserSeeder first.');
            return;
        }

        $salesData = [
            [
                'customer_id' => $customers->random()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'completed',
                'tax_rate' => 11,
                'eta' => now()->addDays(7),
                'notes' => 'Pengiriman via laut ke Singapura',
                'items' => [
                    ['product_index' => 0, 'quantity' => 50],
                    ['product_index' => 1, 'quantity' => 30],
                ],
            ],
            [
                'customer_id' => $customers->random()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'shipped',
                'tax_rate' => 11,
                'eta' => now()->addDays(14),
                'notes' => 'Express shipment via udara',
                'items' => [
                    ['product_index' => 2, 'quantity' => 100],
                    ['product_index' => 3, 'quantity' => 75],
                    ['product_index' => 4, 'quantity' => 25],
                ],
            ],
            [
                'customer_id' => $customers->random()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'processing',
                'tax_rate' => 11,
                'eta' => now()->addDays(21),
                'notes' => 'Menunggu dokumen ekspor',
                'items' => [
                    ['product_index' => 5, 'quantity' => 200],
                ],
            ],
            [
                'customer_id' => $customers->random()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'confirmed',
                'tax_rate' => 11,
                'eta' => now()->addDays(30),
                'notes' => 'Order konfirmasi, menunggu pembayaran DP',
                'items' => [
                    ['product_index' => 0, 'quantity' => 150],
                    ['product_index' => 2, 'quantity' => 80],
                ],
            ],
            [
                'customer_id' => $customers->random()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'quotation',
                'tax_rate' => 11,
                'eta' => now()->addDays(45),
                'notes' => 'Quotation untuk prospek baru',
                'items' => [
                    ['product_index' => 1, 'quantity' => 500],
                    ['product_index' => 3, 'quantity' => 300],
                    ['product_index' => 5, 'quantity' => 150],
                ],
            ],
            [
                'customer_id' => $customers->first()->id,
                'seller_id' => $sellers->first()->id,
                'status' => 'completed',
                'tax_rate' => 10,
                'eta' => now()->subDays(30),
                'notes' => 'Order sudah selesai dan dibayar',
                'items' => [
                    ['product_index' => 4, 'quantity' => 100],
                    ['product_index' => 6, 'quantity' => 50],
                ],
            ],
            [
                'customer_id' => $customers->skip(1)->first()->id ?? $customers->first()->id,
                'seller_id' => $sellers->random()->id,
                'status' => 'completed',
                'tax_rate' => 11,
                'eta' => now()->subDays(15),
                'notes' => 'Pengiriman reguler bulanan',
                'items' => [
                    ['product_index' => 0, 'quantity' => 75],
                    ['product_index' => 1, 'quantity' => 60],
                    ['product_index' => 2, 'quantity' => 40],
                ],
            ],
        ];

        foreach ($salesData as $index => $data) {
            $sale = Sale::create([
                'customer_id' => $data['customer_id'],
                'seller_id' => $data['seller_id'],
                'status' => $data['status'],
                'tax_rate' => $data['tax_rate'],
                'eta' => $data['eta'],
                'notes' => $data['notes'],
                'subtotal' => 0,
                'tax_amount' => 0,
                'total' => 0,
            ]);

            // Add items
            foreach ($data['items'] as $item) {
                $product = $products[$item['product_index'] % $products->count()];
                
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total_price' => $product->price * $item['quantity'],
                ]);
            }

            // Recalculate totals
            $sale->calculateTotals();

            // Add status history
            $statuses = $this->getStatusHistory($data['status']);
            $date = now()->subDays(count($statuses) * 2);
            
            foreach ($statuses as $status) {
                SaleStatusHistory::create([
                    'sale_id' => $sale->id,
                    'from_status' => $status['from'],
                    'to_status' => $status['to'],
                    'changed_by' => $data['seller_id'],
                    'notes' => $status['notes'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $date = $date->addDays(2);
            }

            $this->command->info("Created Sale #{$sale->sale_number} with " . count($data['items']) . " items");
        }

        $this->command->info('Sales seeded successfully!');
    }

    private function getStatusHistory(string $currentStatus): array
    {
        $statusFlow = [
            'quotation' => [],
            'confirmed' => [
                ['from' => 'quotation', 'to' => 'confirmed', 'notes' => 'Customer confirmed order'],
            ],
            'processing' => [
                ['from' => 'quotation', 'to' => 'confirmed', 'notes' => 'Customer confirmed order'],
                ['from' => 'confirmed', 'to' => 'processing', 'notes' => 'Payment received, processing started'],
            ],
            'shipped' => [
                ['from' => 'quotation', 'to' => 'confirmed', 'notes' => 'Customer confirmed order'],
                ['from' => 'confirmed', 'to' => 'processing', 'notes' => 'Payment received'],
                ['from' => 'processing', 'to' => 'shipped', 'notes' => 'Goods shipped via sea freight'],
            ],
            'completed' => [
                ['from' => 'quotation', 'to' => 'confirmed', 'notes' => 'Customer confirmed order'],
                ['from' => 'confirmed', 'to' => 'processing', 'notes' => 'DP received'],
                ['from' => 'processing', 'to' => 'shipped', 'notes' => 'Shipped'],
                ['from' => 'shipped', 'to' => 'completed', 'notes' => 'Delivered and payment completed'],
            ],
        ];

        return $statusFlow[$currentStatus] ?? [];
    }
}
