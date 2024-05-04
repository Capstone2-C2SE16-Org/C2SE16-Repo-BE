<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\StudentRequest;
use Illuminate\Http\Request;
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

    public function store(StoreStudentRequest $request)
    {
        $this->authorize('student_requests.create');

        $validatedData = $request->validated();

        // $studentRequest = Auth::user()->student_requests()->create($validatedData);

        $studentRequest = Auth::manager()->student_requests()->create($validatedData);

        return response()->json($studentRequest, 201);
    }
}
