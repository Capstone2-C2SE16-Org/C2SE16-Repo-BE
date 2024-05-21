<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Manager;
use App\Models\StudentRequest;
use Illuminate\Support\Facades\Auth;

class StudentRequestController extends Controller
{
    //
    public function index()
    {
        $this->authorize('student_requests.view');

        $studentRequests = StudentRequest::all();

        return response()->json($studentRequests);
    }

    public function show($id)
    {
        $this->authorize('student_requests.view');

        $studentRequest = StudentRequest::findOrFail($id);

        return response()->json($studentRequest);
    }
 
    public function store(StoreStudentRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['student_id'] = Auth::id();

        $teacher = Manager::role('teacher')->inRandomOrder()->first();

        if (!$teacher) {
            return response()->json(['message' => 'No teacher available to assign request.'], 422);
        }

        $validatedData['manager_id'] = $teacher->id;
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
