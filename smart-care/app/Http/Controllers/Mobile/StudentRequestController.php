<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Classroom;
use App\Models\Manager;
use App\Models\Student;
use App\Models\StudentRequest;
use Illuminate\Support\Facades\Auth;

class StudentRequestController extends Controller
{
    //
    public function index()
    {
        $this->authorize('student_requests.view');

        $studentRequests = StudentRequest::with('student', 'manager')->get();

        return response()->json($studentRequests);
    }

    public function show($id)
    {
        $this->authorize('student_requests.view');

        $studentRequest = StudentRequest::with('student', 'manager')->findOrFail($id);

        return response()->json($studentRequest);
    }


    public function store(StoreStudentRequest $request)
    {
        $validatedData = $request->validated();
        $studentId = Auth::id();
    
        $student = Student::with('classroom.managers')->find($studentId);
    
        if (!$student || !$student->classroom) {
            return response()->json(['message' => 'No classroom found for the student.'], 422);
        }
    
        $manager = $student->classroom->managers->first(function ($manager) {
            return $manager->roles->contains('name', 'teacher');
        });
    
        if (!$manager) {
            return response()->json(['message' => 'No teacher available to assign request.'], 422);
        }
    
        $validatedData['manager_id'] = $manager->id; 
        $validatedData['student_id'] = $studentId;
        $validatedData['status'] = false; 
    
        $studentRequest = StudentRequest::create($validatedData);
    
        return response()->json($studentRequest, 201);
    }

    public function update(StoreStudentRequest $request, $id)
    {
        $studentRequest = StudentRequest::findOrFail($id);

        $this->authorize('student_requests.update', $studentRequest);

        $validatedData = $request->validated();
        $validatedData['status'] = true;

        $studentRequest->update($validatedData);

        return response()->json($studentRequest);
    }

    public function destroy($id)
    {
        $studentRequest = StudentRequest::findOrFail($id);

        $this->authorize('student_requests.delete', $studentRequest);

        $studentRequest->delete();

        return response()->json(['message' => 'Request deleted successfully.'], 200);
    }
}
