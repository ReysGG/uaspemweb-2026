<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default roles
        Role::firstOrCreate(['name' => 'super_admin']);
        
        // BRD Roles (Stakeholders)
        Role::firstOrCreate(['name' => 'owner', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'penjual', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'pembeli', 'guard_name' => 'web']);
    }
}
