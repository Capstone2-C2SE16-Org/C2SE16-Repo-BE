<?php

namespace Database\Seeders;

use App\Models\Fee;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fees = [
            ['name' => 'Học phí', 'price' => 1000000], 
            ['name' => 'Tiền ăn', 'price' => 500000],  
            ['name' => 'Hoạt động ngoại khóa', 'price' => 300000], 
            ['name' => 'Khoản thu khác', 'price' => 200000],  
        ];

        foreach ($fees as $fee) {
            Fee::create($fee);
        }
    }
}
