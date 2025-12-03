<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;

class TeacherSubjectAssignmentController extends Controller
{
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        $grades = Grade::all();

        return view('admin.assignments.create', compact('teachers', 'subjects', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);
        
        // Attach the subject to the teacher with the grade_id in the pivot table
        $teacher->subjects()->attach($request->subject_id, ['grade_id' => $request->grade_id]);

        return redirect()->route('assignments.create')->with('success', 'Subject assigned to teacher successfully.');
    }
}
