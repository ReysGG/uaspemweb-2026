<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Elektronik
            [
                'category_slug' => 'elektronik',
                'code' => 'ELEC-001',
                'hs_code' => '8471.30',
                'name' => 'Laptop Komputer',
                'description' => 'Laptop untuk keperluan bisnis',
                'price' => 15000000,
                'stock' => 50,
                'unit' => 'unit',
            ],
            [
                'category_slug' => 'elektronik',
                'code' => 'ELEC-002',
                'hs_code' => '8517.12',
                'name' => 'Smartphone',
                'description' => 'Smartphone Android terbaru',
                'price' => 5000000,
                'stock' => 100,
                'unit' => 'unit',
            ],
            // Tekstil
            [
                'category_slug' => 'tekstil',
                'code' => 'TEXT-001',
                'hs_code' => '5208.11',
                'name' => 'Kain Katun Polos',
                'description' => 'Kain katun berkualitas tinggi',
                'price' => 75000,
                'stock' => 1000,
                'unit' => 'meter',
            ],
            [
                'category_slug' => 'tekstil',
                'code' => 'TEXT-002',
                'hs_code' => '6203.42',
                'name' => 'Celana Jeans',
                'description' => 'Celana jeans denim',
                'price' => 250000,
                'stock' => 500,
                'unit' => 'pcs',
            ],
            // Mesin & Peralatan
            [
                'category_slug' => 'mesin-peralatan',
                'code' => 'MACH-001',
                'hs_code' => '8421.21',
                'name' => 'Water Filter Industrial',
                'description' => 'Filter air untuk industri',
                'price' => 50000000,
                'stock' => 10,
                'unit' => 'unit',
            ],
            // Makanan & Minuman
            [
                'category_slug' => 'makanan-minuman',
                'code' => 'FOOD-001',
                'hs_code' => '0901.11',
                'name' => 'Kopi Arabika',
                'description' => 'Biji kopi arabika premium',
                'price' => 150000,
                'stock' => 2000,
                'unit' => 'kg',
            ],
            [
                'category_slug' => 'makanan-minuman',
                'code' => 'FOOD-002',
                'hs_code' => '1513.11',
                'name' => 'Minyak Kelapa Sawit',
                'description' => 'CPO grade A',
                'price' => 12000,
                'stock' => 10000,
                'unit' => 'liter',
            ],
            // Kerajinan
            [
                'category_slug' => 'kerajinan',
                'code' => 'CRAF-001',
                'hs_code' => '4602.11',
                'name' => 'Keranjang Rotan',
                'description' => 'Keranjang anyaman rotan',
                'price' => 85000,
                'stock' => 300,
                'unit' => 'pcs',
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::where('slug', $productData['category_slug'])->first();
            
            if ($category) {
                unset($productData['category_slug']);
                Product::firstOrCreate(
                    ['code' => $productData['code']],
                    array_merge($productData, ['category_id' => $category->id])
                );
            }
        }
    }
}
