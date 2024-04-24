<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::latest()->paginate(5);
        
        return view('students.index',compact('students'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parents = Parents::all();
        return view('students.create', compact('parents'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'email' => 'required',
            'gender' => 'required',
            // 'profile_image' => 'required',
            'name_parent' => 'required',
            'date_of_birth_parent' => ['required', 'date', 'before_or_equal:today'],
            'gender_parent' => 'required',
            'phone_number' => 'required',
            'username' => 'required|unique:students',
            'password' => 'required',
            // 'is_enable' => 'required',
            // 'price' => 'required | integer',
            'classroom_id' => 'required|exists:classrooms,id',

        ]);

        $student = Student::create([
            'name' => $request->name,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'classroom_id' => $request->classroom_id,
        ]);
        $student -> parents()->create([
            'name' => $request->name_parent,
            'date_of_birth' => $request->date_of_birth_parent,
            'gender' => $request->gender_parent,
        ]);

        return redirect()->route('students.index')
                        ->with('success','Học sinh đã được tạo thành công!');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        $parent = Parents::where('student_id', $student->id)->first();
        // Truyền thông tin về phụ huynh vào view
        return view('students.show',compact('student', 'parent'));

    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        return view('students.edit',compact('student'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            // 'profile_image' => 'required',
            'phone_number' => 'required',
            'username' => 'required|unique:students,username,' . $student->id,
            'password' => 'required',
            // 'is_enable' => 'required',
            'classroom_id' => 'required|exists:classrooms,id',

        ]);
        
        $student->update($request->all());
        
        return redirect()->route('students.index')
                        ->with('success','Học sinh đã được cập nhật thành công!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
         
        return redirect()->route('students.index')
                        ->with('success','Học sinh đã được xóa thành công!');
    }
}
