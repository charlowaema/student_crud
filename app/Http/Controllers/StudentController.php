<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        //return response()->json(Student::all());
          $perPage = $request->get('per_page', 5);
          $search = $request->get('search', '');

          $students = Student::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('course', 'like', "%$search%");
        })
        ->paginate($perPage);

    return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students',
            'course' => 'required|string|max:255',
        ]);

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email,' . $id,
            'course' => 'required|string|max:255',
        ]);

        $student->update($request->all());
        return response()->json($student);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}