<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactBookDetailResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactBookController extends Controller
{
    public function myContactBook(Request $request)
    {
        $studentId = Auth::id();
        $student = Student::with(['contact_books', 'classroom'])->find($studentId);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $contactBook = $student->contact_books;

        if (!$contactBook) {
            return response()->json(['message' => 'Contact book not found'], 404);
        }
 
        $data = [
            'name' => $student->name,
            'nickname' => $student->nickname,
            'date_of_birth' => $student->date_of_birth,
            'profile_image' => $student->profile_image,
            'classroom' => $student->classroom->name,
            'health_information' => [
                'height' => $contactBook->height,
                'weight' => $contactBook->weight,
                'blood_group' => $contactBook->blood_group,
                'blood_pressure' => $contactBook->blood_pressure,
                'vision_test' => $contactBook->vision_test,
                'allergies' => $contactBook->allergies,
            ],
            'total_absences' => $contactBook->total_absences,
            'good_behavior_certificates' => $contactBook->good_behavior_certificates,
            'comment' => $contactBook->comment
        ];

        return response()->json($data);
    }

    public function showContactBook($classroomId, $studentId)
    {
        $classroom = Classroom::with('managers')->findOrFail($classroomId);

        $user = Auth::user();
        if (!$classroom->managers->contains($user->id)) {
            return response()->json(['message' => 'Unauthorized access - not your classroom'], 403);
        }

        $student = $classroom->students()->where('id', $studentId)->with('contact_books')->firstOrFail();
        $contactBook = $student->contact_books;

        return response()->json(new ContactBookDetailResource($contactBook));
    }
}
