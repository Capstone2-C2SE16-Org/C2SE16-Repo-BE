<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MealSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MealScheduleController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $startOfWeek->copy()->addDays(4);

        $schedules = MealSchedule::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        return response()->json($schedules);
    }

    public function store()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);

        $existingCount = MealSchedule::whereBetween('date', [$startOfWeek, $startOfWeek->copy()->addDays(4)])->count();
        if ($existingCount > 0) {
            return response()->json(['message' => 'Meal schedules already exist for this week'], 409);
        }

        $mealsForTheWeek = $this->generateWeeklyMealPlanForKids();
        foreach ($mealsForTheWeek as $day => $meals) {
            MealSchedule::create([
                'date' => $startOfWeek->copy()->addDays($day),
                'morning' => $meals['morning'],
                'noon' => $meals['noon'],
                'afternoon' => $meals['afternoon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Meal schedules created successfully for the week'], 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = MealSchedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Meal schedule not found'], 404);
        }

        $schedule->update($request->only(['morning', 'noon', 'afternoon']));
        return response()->json($schedule);
    }

    public function destroy($id)
    {
        $schedule = MealSchedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Meal schedule not found'], 404);
        }
    
        $schedule->delete();
        return response()->json(['message' => 'Meal schedule successfully deleted'], 200);
    }

    private function generateWeeklyMealPlanForKids()
    {
        $categories = [
            'grains' => ['Bánh mì nguyên cám', 'Bún', 'Phở', 'Bánh mỳ'],
            'proteins' => ['Thịt gà', 'Cá hồi', 'Trứng', 'Sữa đậu nành'],
            'dairy' => ['Sữa tươi', 'Sữa chua', 'Phô mai'],
            'fruits' => ['Chuối', 'Táo', 'Cam', 'Dưa hấu'],
            'vegetables' => ['Rau cải', 'Cà rốt', 'Cà chua', 'Dưa chuột']
        ];

        $mealPlan = [];
        for ($i = 0; $i < 5; $i++) { 
            $mealPlan[] = [
                'morning' => $this->randomMeal(['grains', 'dairy'], $categories),
                'noon' => $this->randomMeal(['proteins', 'vegetables', 'grains'], $categories),
                'afternoon' => $this->randomMeal(['fruits'], $categories)
            ];
        }
        return $mealPlan;
    }

    private function randomMeal(array $mealTypes, array $categories)
    {
        $meal = [];
        foreach ($mealTypes as $type) {
            $meal[] = $categories[$type][array_rand($categories[$type])];
        }
        return implode(', ', $meal); 
    }
}
