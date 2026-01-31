<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Produk elektronik dan komponen',
            ],
            [
                'name' => 'Tekstil',
                'slug' => 'tekstil',
                'description' => 'Kain, garmen, dan produk tekstil',
            ],
            [
                'name' => 'Mesin & Peralatan',
                'slug' => 'mesin-peralatan',
                'description' => 'Mesin industri dan peralatan berat',
            ],
            [
                'name' => 'Bahan Baku',
                'slug' => 'bahan-baku',
                'description' => 'Bahan mentah untuk produksi',
            ],
            [
                'name' => 'Makanan & Minuman',
                'slug' => 'makanan-minuman',
                'description' => 'Produk F&B untuk ekspor',
            ],
            [
                'name' => 'Kerajinan',
                'slug' => 'kerajinan',
                'description' => 'Produk kerajinan tangan dan furniture',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
