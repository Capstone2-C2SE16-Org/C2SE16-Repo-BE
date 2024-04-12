<?php

namespace Database\Seeders;

use App\Models\MealSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MealSchedule::create([
            'date' => '2024-5-5',
            'morning' => 'Sua tuoi Vinamilk',
            'noon' => 'Súp bò, bánh mỳ, Salad',
            'afternoon' => 'Sữa chua Hy Lạp',
        ]);

        MealSchedule::create([
            'date' => '2024-5-6',
            'morning' => 'Ngũ cốc',
            'noon' => 'Cháo dinh dưỡng, Dưa lưới, Salad',
            'afternoon' => 'Nước cam ép',
        ]);

        MealSchedule::create([
            'date' => '2024-5-7',
            'morning' => 'Sữa tươi',
            'noon' => 'Cơm dương châu, Nho Mỹ, Salad cá ngừ',
            'afternoon' => 'Nước ép ổi',
        ]);
    }
}
