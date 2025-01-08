<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesmanSeeder extends Seeder
{
    public function run()
    {
        DB::table('salesman')->insert([
            [
                'salesman_id' => 1,
                'salesman_name' => 'Lauda',
                'salesman_city' => 'New York',
                'commission' => 0.15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'salesman_id' => 2,
                'salesman_name' => 'Miomio',
                'salesman_city' => 'Los Angeles',
                'commission' => 0.12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'salesman_id' => 3,
                'salesman_name' => 'Kamilie',
                'salesman_city' => 'Houston',
                'commission' => 0.10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'salesman_id' => 4,
                'salesman_name' => 'Agus',
                'salesman_city' => 'Chicago',
                'commission' => 0.14,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
