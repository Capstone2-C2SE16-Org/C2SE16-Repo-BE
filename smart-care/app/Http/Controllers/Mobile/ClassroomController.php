<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();
        return response()->json($classrooms);
    }

    public function show($classroomId)
    {
        $classroom = Classroom::find($classroomId);
        return response()->json($classroom);
    }

    public function assignTeacher(Request $request, $classroomId)
    {
        $this->authorize('classrooms.manage');

        $classroom = Classroom::findOrFail($classroomId);
        $teacherId = $request->input('teacher_id');

        $teacher = Manager::findOrFail($teacherId);
        if (!$teacher->hasRole('teacher')) {
            return response()->json(['message' => 'Assigned user is not a teacher'], 400);
        }

        if ($classroom->managers()->where('manager_id', $teacherId)->exists()) {
            return response()->json(['message' => 'Teacher already assigned to this classroom'], 409);
        }

        $classroom->managers()->attach($teacherId);
        return response()->json(['message' => 'Teacher assigned successfully']);
    }

    public function getClassroomSchedule($classroomId)
    {
        $classroom = Classroom::with('learning_schedules')->findOrFail($classroomId);
        $user = Auth::user();

        if ($user->is_student && !$classroom->students->contains('user_id', $user->id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($classroom->learning_schedules);
    }

    public function getClassroom($classroomId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $user = Auth::user();

        if ($user->is_student && !$classroom->students->contains('user_id', $user->id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new ClassroomResource($classroom);
    }

    public function getCurrentWeek($classroomId)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $classroom = Classroom::with(['learning_schedules' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->where('date', '>=', $startOfWeek)
                ->where('date', '<', $endOfWeek);
        }])->findOrFail($classroomId);

        return response()->json($classroom->learning_schedules);
    }
}
