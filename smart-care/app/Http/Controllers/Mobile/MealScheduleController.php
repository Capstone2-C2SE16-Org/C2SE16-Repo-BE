<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\MealSchedule;
use Carbon\Carbon;

class MealScheduleController extends Controller
{
    public function getCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->addDays(5); 

        $mealSchedules = MealSchedule::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        return response()->json($mealSchedules);
    }

    public function getNextWeek()
    {
        $startOfNextWeek = Carbon::now()->addWeek()->startOfWeek();
        $endOfNextWeek = $startOfNextWeek->copy()->addDays(5);

        $mealSchedules = MealSchedule::whereBetween('date', [$startOfNextWeek, $endOfNextWeek])->get();

        if ($mealSchedules->isEmpty()) {
            return response()->json(['message' => 'Meal schedules for the next week will be generated.']);
        }

        return response()->json($mealSchedules);
    }
}
