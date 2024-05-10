<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Student;
// use App\Models\StudentRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('parent')->paginate(10);

        return response()->json($students);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = Student::with('parent')->findOrFail($id);

        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());

        $parent = new Parents([
            'name' => $request->input('parent_name'),
            'date_of_birth' => $request->input('parent_date_of_birth'),
            'gender' => $request->input('parent_gender'),
            'student_id' => $student->id
        ]);
        $parent->save();

        return response()->json(['student' => $student, 'parent' => $parent], 201);
    }

    // public function update(StudentRequest $request, $id)
    // {
    //     // Retrieve the student by id, or fail with a 404 error
    //     $student = Student::findOrFail($id);

    //     // Update the student using the validated data from the request
    //     $student->update($request->validated());

    //     // Optionally, update parent information if provided
    //     if ($request->has('parent_name')) {
    //         $parent = $student->parent;
    //         $parent->update([
    //             'name' => $request->parent_name,
    //             'date_of_birth' => $request->parent_date_of_birth,
    //             'gender' => $request->parent_gender
    //         ]);
    //     }

    //     // Return the updated student data
    //     return response()->json(['student' => $student, 'parent' => $student->parent], 200);
    // }
    // public function update(StudentRequest $request, $id)
    // {
    //     $student = Student::findOrFail($id);
    //     $student->update($request->validated());

    //     if ($request->has('parent_name')) {
    //         $parent = $student->parent ?? new Parents(['student_id' => $student->id]);
    //         $parent->fill([
    //             'name' => $request->parent_name,
    //             'date_of_birth' => $request->parent_date_of_birth,
    //             'gender' => $request->parent_gender
    //         ])->save();
    //     }
    //     return response()->json(['student' => $student, 'parent' => $student->parent]);
    // }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->validated());

        if ($request->has('parent_name')) {
            $parent = $student->parent ?? new Parents(['student_id' => $student->id]);
            $parent->fill([
                'name' => $request->parent_name,
                'date_of_birth' => $request->parent_date_of_birth,
                'gender' => $request->parent_gender
            ])->save();
        }

        return response()->json(['student' => $student, 'parent' => $student->parent]);
    }

    public function destroy($id)
    {
        // Retrieve the student by id, or fail with a 404 error
        $student = Student::findOrFail($id);

        // Optional: handle related data, such as deleting a parent record
        if ($student->parent) {
            $student->parent->delete();
        }

        // Delete the student
        $student->delete();

        // Return a 204 No Content response to signify successful deletion
        return response()->json(null, 204);
    }
}
