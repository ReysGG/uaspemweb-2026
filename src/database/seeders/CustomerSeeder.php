<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyerUser = User::where('email', 'buyer@customer.com')->first();

        $customers = [
            [
                'code' => 'CUST-00001',
                'name' => 'John Smith',
                'company' => 'Global Trade Inc.',
                'email' => 'john@globaltrade.com',
                'phone' => '+1-555-123-4567',
                'address' => '123 Business Ave, New York, NY 10001',
                'country' => 'United States',
                'user_id' => null,
            ],
            [
                'code' => 'CUST-00002',
                'name' => 'Tanaka Hiroshi',
                'company' => 'Tokyo Import Co., Ltd',
                'email' => 'tanaka@tokyoimport.jp',
                'phone' => '+81-3-1234-5678',
                'address' => '1-2-3 Shibuya, Tokyo 150-0001',
                'country' => 'Japan',
                'user_id' => null,
            ],
            [
                'code' => 'CUST-00003',
                'name' => 'Li Wei',
                'company' => 'Shenzhen Electronics Trading',
                'email' => 'liwei@szelectronics.cn',
                'phone' => '+86-755-8888-9999',
                'address' => 'Building A, Tech Park, Shenzhen 518000',
                'country' => 'China',
                'user_id' => null,
            ],
            [
                'code' => 'CUST-00004',
                'name' => 'Customer Demo',
                'company' => 'Demo Company Pte Ltd',
                'email' => 'buyer@customer.com',
                'phone' => '+65-6789-0123',
                'address' => '10 Anson Road, Singapore 079903',
                'country' => 'Singapore',
                'user_id' => $buyerUser?->id,
            ],
            [
                'code' => 'CUST-00005',
                'name' => 'Mohammed Al-Rashid',
                'company' => 'Dubai Imports LLC',
                'email' => 'rashid@dubaiimports.ae',
                'phone' => '+971-4-555-6666',
                'address' => 'Dubai Trade Center, Sheikh Zayed Road',
                'country' => 'United Arab Emirates',
                'user_id' => null,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(
                ['code' => $customer['code']],
                $customer
            );
        }
    }
}
