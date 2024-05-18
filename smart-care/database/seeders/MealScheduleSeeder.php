<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealScheduleSeeder extends Seeder
{

    protected $grains = ['Bánh mì nguyên cám', 'Bún', 'Phở', 'Bánh mỳ'];
    protected $proteins = ['Thịt gà', 'Cá hồi', 'Trứng', 'Sữa đậu nành'];
    protected $dairy = ['Sữa tươi', 'Sữa chua', 'Phô mai'];
    protected $fruits = ['Chuối', 'Táo', 'Cam', 'Dưa hấu'];
    protected $vegetables = ['Rau cải', 'Cà rốt', 'Cà chua', 'Dưa chuột'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $mealsForTheWeek = $this->generateWeeklyMealPlan();

        for ($day = 0; $day < 5; $day++) {
            $date = $startOfWeek->copy()->addDays($day);
            $meals = $mealsForTheWeek[$day];

            DB::table('meal_schedules')->insert([
                'date' => $date->toDateString(),
                'morning' => $meals['morning'],
                'noon' => $meals['noon'],
                'afternoon' => $meals['afternoon'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    private function generateWeeklyMealPlan(): array
    {
        $weeklyMealPlan = [];
        for ($i = 0; $i < 5; $i++) {
            $weeklyMealPlan[] = [
                'morning' => $this->randomMeal(['grains', 'dairy']),
                'noon' => $this->randomMeal(['proteins', 'vegetables', 'grains']),
                'afternoon' => $this->randomMeal(['fruits'])
            ];
        }
        return $weeklyMealPlan;
    }

    private function randomMeal(array $groups): string
    {
        $meal = [];
        foreach ($groups as $group) {
            $item = $this->{"{$group}"}[array_rand($this->{"{$group}"})];
            $meal[] = $item;
        }
        return implode(', ', $meal);
    }
}
