<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profileImage = Storage::url($path);
            $data['profile_image'] = $profileImage;
        }

        $student = Student::create($data);

        $parent = new Parents([
            'name' => $request->input('parent_name'),
            'date_of_birth' => $request->input('parent_date_of_birth'),
            'gender' => $request->input('parent_gender'),
            'student_id' => $student->id
        ]);
        $parent->save();
        $student->address = $student->getFullAddressAttribute();
        $student->save();

        return response()->json(['student' => $student, 'parent' => $parent], 201);
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($student->profile_image) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profileImage = Storage::url($path);
            $data['profile_image'] = $profileImage;
        }

        $student->update($data);

        if ($request->has(['parent_name', 'parent_date_of_birth', 'parent_gender'])) {
            $parent = $student->parent ?? new Parents(['student_id' => $student->id]);
            $parent->fill([
                'name' => $request->parent_name,
                'date_of_birth' => $request->parent_date_of_birth,
                'gender' => $request->parent_gender
            ])->save();
        }

        $student->address = $student->getFullAddressAttribute();
        $student->save();

        return response()->json(['student' => $student, 'parent' => $student->parent]);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->parent) {
            $student->parent->delete();
        }

        $student->delete();

        return response()->json(['message' => 'Student and associated parent record deleted successfully.'], 200);
    }
}
