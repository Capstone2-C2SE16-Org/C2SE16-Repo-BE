<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\ContactBookResource;
use App\Http\Resources\StudentDetailResource;
use App\Models\Classroom;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

    public function listStudents($classroomId)
    {
        $classroom = Classroom::with('students')->findOrFail($classroomId);

        $this->authorize('view', $classroom);

        $students = $classroom->students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'nickname' => $student->nickname,
                'profile_image' => $student->profile_image
            ];
        });

        return response()->json($students);
    }

    public function getStudentDetails($classroomId, $studentId)
    {
        $classroom = Classroom::with(['students' => function ($query) use ($studentId) {
            $query->where('id', $studentId)->with('parent');
        }])->findOrFail($classroomId);

        $this->authorize('view', $classroom);

        if ($classroom->students->isEmpty()) {
            return response()->json(['message' => 'Student not found in this classroom'], 404);
        }

        $student = $classroom->students->first();

        return new StudentDetailResource($student);
    }

    public function updateContactBook(Request $request, $classroomId, $studentId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        
        if (!$this->authorize('manage', $classroom)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $student = $classroom->students()->where('id', $studentId)->firstOrFail();
        $contactBook = $student->contact_books()->firstOrCreate(['student_id' => $studentId]);

        $validated = $request->validate([
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'blood_group' => 'required|string',
            'blood_pressure' => 'required|string',
            'vision_test' => 'required|string',
            'allergies' => 'nullable|string',
            'total_absences' => 'required|integer',
            'good_behavior_certificates' => 'nullable|array',
            'comment' => 'nullable|string',
        ]);

        $contactBook->update($validated);

        return response()->json([
            'message' => 'Contact book updated successfully',
            'data' => new ContactBookResource($contactBook)
        ]);
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

    public function getTeacherClassrooms(Request $request)
    {
        $teacher = Auth::user();

        if (!$teacher->roles->contains('name', 'teacher')) {
            return response()->json(['message' => 'User is not a teacher'], 400);
        }

        $classrooms = $teacher->classrooms->map(function ($classroom) {
            return [
                'id' => $classroom->id,
                'name' => $classroom->name,
                'students' => $classroom->students->map(function ($student) {
                    return [
                        'id' => $student->id,
                        'name' => $student->name,
                        'nickname' => $student->nickname,
                        'profile_image' => $student->profile_image,
                    ];
                }),
            ];
        });

        return response()->json($classrooms);
    }
}
