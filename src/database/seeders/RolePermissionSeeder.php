<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Assign permissions to roles based on BRD:
     * - Owner: Monitoring kinerja, akses laporan strategis
     * - Admin: Manage semua data, lacak penjualan, generate laporan
     * - Penjual: Input penjualan, generate invoice, manage customer
     * - Pembeli: Menerima invoice, konfirmasi pembayaran (view only)
     */
    public function run(): void
    {
        // Get all permissions
        $allPermissions = Permission::all()->pluck('name')->toArray();
        
        // Get roles - try with web guard first
        $owner = Role::where('name', 'owner')->first();
        $admin = Role::where('name', 'admin')->first();
        $penjual = Role::where('name', 'penjual')->first();
        $pembeli = Role::where('name', 'pembeli')->first();

        if (!$owner || !$admin || !$penjual || !$pembeli) {
            $this->command->warn('Some roles not found. Run RoleSeeder first.');
            return;
        }

        // Owner permissions - full view access + widgets
        $ownerPermissions = array_filter($allPermissions, function($perm) {
            return str_starts_with($perm, 'view_') || str_starts_with($perm, 'widget_');
        });
        $owner->syncPermissions($ownerPermissions);
        $this->command->info("Owner: " . count($ownerPermissions) . " permissions assigned");

        // Admin permissions - full CRUD access to all resources
        $admin->syncPermissions($allPermissions);
        $this->command->info("Admin: " . count($allPermissions) . " permissions assigned");

        // Penjual permissions - CRUD on sales, invoices, customers; view products/categories + widgets
        $penjualPermissions = array_filter($allPermissions, function($perm) {
            // Sales - full CRUD
            if (str_contains($perm, '_sale')) return true;
            // Invoice - full CRUD
            if (str_contains($perm, '_invoice')) return true;
            // Customer - full CRUD  
            if (str_contains($perm, '_customer')) return true;
            // Products - view only
            if ($perm === 'view_any_product' || $perm === 'view_product') return true;
            // Categories - view only
            if ($perm === 'view_any_category' || $perm === 'view_category') return true;
            // Widgets
            if (str_starts_with($perm, 'widget_')) return true;
            // Page access
            if (str_contains($perm, 'page_')) return true;
            
            return false;
        });
        $penjual->syncPermissions($penjualPermissions);
        $this->command->info("Penjual: " . count($penjualPermissions) . " permissions assigned");

        // Pembeli permissions - view only on invoices, sales, products, categories + widgets
        $pembeliPermissions = array_filter($allPermissions, function($perm) {
            if ($perm === 'view_any_invoice' || $perm === 'view_invoice') return true;
            if ($perm === 'view_any_sale' || $perm === 'view_sale') return true;
            if ($perm === 'view_any_product' || $perm === 'view_product') return true;
            if ($perm === 'view_any_category' || $perm === 'view_category') return true;
            if (str_starts_with($perm, 'widget_')) return true;
            
            return false;
        });
        $pembeli->syncPermissions($pembeliPermissions);
        $this->command->info("Pembeli: " . count($pembeliPermissions) . " permissions assigned");

        $this->command->info('Role permissions assigned successfully!');
    }
}
