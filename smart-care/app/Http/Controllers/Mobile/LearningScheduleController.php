<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\LearningSchedule;
use Illuminate\Http\Request;

class LearningScheduleController extends Controller
{
    public function store(Request $request, $classroomId)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'morning' => 'required|string',
            'noon' => 'nullable|string',
            'afternoon' => 'nullable|string',
        ]);

        $schedule = new LearningSchedule($validated);
        $schedule->save();

        $classroom = Classroom::findOrFail($classroomId);
        $classroom->learning_schedules()->attach($schedule->id);

        return response()->json($schedule, 201);
    }

    public function update(Request $request, $classroomId, $scheduleId)
    {
        $validated = $request->validate([
            'name' => 'string',
            'date' => 'date',
            'morning' => 'string|nullable',
            'noon' => 'string|nullable',
            'afternoon' => 'string|nullable',
        ]);

        $classroom = Classroom::findOrFail($classroomId);
        $schedule = $classroom->learning_schedules()->findOrFail($scheduleId);
        $schedule->update($validated);

        return response()->json($schedule);
    }

    public function destroy($classroomId, $scheduleId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $schedule = $classroom->learning_schedules()->findOrFail($scheduleId);
    
        $classroom->learning_schedules()->detach($scheduleId);
        $schedule->delete();
    
        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}
