<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\MealSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MealScheduleController extends Controller
{
    // public function getCurrentWeek()
    // {
    //     $today = Carbon::today();

    //     if ($today->isWeekend() || ($today->dayOfWeek === Carbon::FRIDAY && now()->hour >= 15)) {
    //         $nextMonday = $today->next(Carbon::MONDAY);
    //         $mealSchedules = MealSchedule::whereBetween('date', [$nextMonday, $nextMonday->copy()->addDays(4)])->get();

    //         if ($mealSchedules->isEmpty()) {
    //             $this->generateWeeklyMealPlan($nextMonday);
    //             $mealSchedules = MealSchedule::whereBetween('date', [$nextMonday, $nextMonday->copy()->addDays(4)])->get();
    //         }

    //         return response()->json($mealSchedules);
    //     }

    //     $mealSchedule = MealSchedule::where('date', $today)->first();
    //     if (!$mealSchedule && !$today->isWeekend()) {
    //         $this->generateWeeklyMealPlan($today->startOfWeek());
    //         $mealSchedule = MealSchedule::where('date', $today)->first();
    //     }

    //     return response()->json($mealSchedule ?: ['error' => 'No meal scheduled for today']);
    // }

    public function getCurrentWeek()
    {
        $today = Carbon::today();
        $startOfWeek = $today->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $startOfWeek->copy()->addDays(4); 

        $mealSchedules = MealSchedule::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        if ($mealSchedules->isEmpty()) {
            $this->generateWeeklyMealPlan($startOfWeek);
            $mealSchedules = MealSchedule::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        }

        return response()->json($mealSchedules);
    }

    private function generateWeeklyMealPlan(Carbon $startOfWeek): void
    {
        $mealsForTheWeek = [];
        $foodGroups = [
            'grains' => ['Bánh mì nguyên cám', 'Bún', 'Phở', 'Bánh mỳ'],
            'proteins' => ['Thịt gà', 'Cá hồi', 'Trứng', 'Sữa đậu nành'],
            'dairy' => ['Sữa tươi', 'Sữa chua', 'Phô mai'],
            'fruits' => ['Chuối', 'Táo', 'Cam', 'Dưa hấu'],
            'vegetables' => ['Rau cải', 'Cà rốt', 'Cà chua', 'Dưa chuột']
        ];

        for ($i = 0; $i < 5; $i++) {
            $mealsForTheWeek[] = [
                'date' => $startOfWeek->copy()->addDays($i)->toDateString(),
                'morning' => $this->composeMeal($foodGroups, ['grains', 'dairy']),
                'noon' => $this->composeMeal($foodGroups, ['proteins', 'vegetables', 'grains']),
                'afternoon' => $this->composeMeal($foodGroups, ['fruits']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('meal_schedules')->insert($mealsForTheWeek);
    }

    private function composeMeal(array $foodGroups, array $requiredGroups): string
    {
        $meal = [];
        foreach ($requiredGroups as $group) {
            $options = $foodGroups[$group];
            $selectedItem = $options[array_rand($options)];
            $meal[] = $selectedItem;
        }
        return implode(', ', $meal);
    }
}
