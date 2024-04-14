<?php

namespace Database\Seeders;

use App\Models\MealSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MealScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate meal schedules for 30 days
        for ($i = 0; $i < 30; $i++) {
            $date = now()->addDays($i)->toDateString();
            
            DB::table('meal_schedules')->insert([
                'date' => $date,
                'morning' => $faker->sentence(),
                'noon' => $faker->sentence(),
                'afternoon' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



        // MealSchedule::create([
        //     'date' => '2024-5-5',
        //     'morning' => 'Sua tuoi Vinamilk',
        //     'noon' => 'Súp bò, bánh mỳ, Salad',
        //     'afternoon' => 'Sữa chua Hy Lạp',
        // ]);
    }
}
