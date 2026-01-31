<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $superAdmin->assignRole('super_admin');

        // Owner
        $owner = User::firstOrCreate(
            ['email' => 'owner@eksporimpor.com'],
            ['name' => 'Direktur Utama', 'password' => Hash::make('password')]
        );
        $owner->assignRole('owner');

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@eksporimpor.com'],
            ['name' => 'Admin Operasional', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        // Penjual (Sales)
        $penjual1 = User::firstOrCreate(
            ['email' => 'sales1@eksporimpor.com'],
            ['name' => 'Ahmad Salesman', 'password' => Hash::make('password')]
        );
        $penjual1->assignRole('penjual');

        $penjual2 = User::firstOrCreate(
            ['email' => 'sales2@eksporimpor.com'],
            ['name' => 'Budi Account Manager', 'password' => Hash::make('password')]
        );
        $penjual2->assignRole('penjual');

        // Pembeli (Customer)
        $pembeli = User::firstOrCreate(
            ['email' => 'buyer@customer.com'],
            ['name' => 'Customer Demo', 'password' => Hash::make('password')]
        );
        $pembeli->assignRole('pembeli');
    }
}
