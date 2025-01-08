<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'order_id' => 1,
                'order_date' => '2023-01-01',
                'amount' => 200.00,
                'customer_id' => 1,
                'salesman_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 2,
                'order_date' => '2023-01-02',
                'amount' => 250.00,
                'customer_id' => 2,
                'salesman_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 3,
                'order_date' => '2023-01-03',
                'amount' => 150.00,
                'customer_id' => 3,
                'salesman_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 4,
                'order_date' => '2023-01-04',
                'amount' => 300.00,
                'customer_id' => 4,
                'salesman_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 5,
                'order_date' => '2023-01-05',
                'amount' => 400.00,
                'customer_id' => 1,
                'salesman_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 6,
                'order_date' => '2023-01-06',
                'amount' => 350.00,
                'customer_id' => 2,
                'salesman_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 7,
                'order_date' => '2023-01-07',
                'amount' => 500.00,
                'customer_id' => 3,
                'salesman_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 8,
                'order_date' => '2023-01-08',
                'amount' => 200.00,
                'customer_id' => 4,
                'salesman_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
