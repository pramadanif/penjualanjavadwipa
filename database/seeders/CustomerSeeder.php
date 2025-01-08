<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            [
                'customer_id' => 1,
                'customer_name' => 'Alpha Corp',
                'customer_city' => 'New York',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'customer_id' => 2,
                'customer_name' => 'Beta Ltd',
                'customer_city' => 'London',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'customer_id' => 3,
                'customer_name' => 'Gamma Inc',
                'customer_city' => 'Sydney',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'customer_id' => 4,
                'customer_name' => 'Delta Corp',
                'customer_city' => 'Madrid',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
