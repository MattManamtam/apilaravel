<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Ensure this is included at the top

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        // Check if there are no students and return a simple message
        if ($students->isEmpty()) {
            return response()->json(['message' => 'No students found'], 200);
        }

        return response()->json($students, 200);
    }

    public function store(Request $request)
    {
        // Validate and create a new student
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'course' => 'required|string',
            'year' => ['required', Rule::in(['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year'])], // Enum validation for year
            'enrolled' => 'required|boolean',
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::find($id);

        return $student
            ? response()->json($student, 200)
            : response()->json(['message' => 'Student not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Validate and update the student if found
        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'course' => 'sometimes|required|string',
            'year' => ['sometimes', 'required', Rule::in(['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year'])], // Enum validation for year
            'enrolled' => 'sometimes|required|boolean',
        ]);

        $student->update($validated);

        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
