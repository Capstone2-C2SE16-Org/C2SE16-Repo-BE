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
        $faker = Faker::create();

        $feeDetails = [
            ['type' => 'Học phí', 'min_price' => 5000000, 'max_price' => 10000000],
            ['type' => 'Tiền ăn bán trú', 'min_price' => 1000000, 'max_price' => 1500000],
            ['type' => 'Hoạt động ngoại khóa', 'min_price' => 300000, 'max_price' => 500000],
            ['type' => 'Khoản thu khác', 'min_price' => 200000, 'max_price' => 500000],
        ];

        foreach ($feeDetails as $feeDetail) {
            $price = $faker->numberBetween($feeDetail['min_price'], $feeDetail['max_price']);
            Fee::create([
                'name' => $feeDetail['type'],
                'price' => $price
            ]);
        }
    }
}
