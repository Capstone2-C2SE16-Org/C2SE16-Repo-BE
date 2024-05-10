<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\LearningSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClassroomLearningScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek()->subDay();

        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            $classroomSchedules = LearningSchedule::where('name', 'LIKE', "%{$classroom->name}%")
                ->whereBetween('date', [$startOfWeek, $endOfWeek])
                ->get();

            $classroom->learning_schedules()->sync($classroomSchedules->pluck('id')->toArray());
        }
    }
}
