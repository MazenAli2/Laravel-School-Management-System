<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user', 'grade', 'section', 'guardian.user'])->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        $sections = Section::all();
        $guardians = Guardian::with('user')->get();
        return view('admin.students.create', compact('grades', 'sections', 'guardians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'grade_id' => ['required', 'exists:grades,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'guardian_id' => ['required', 'exists:guardians,id'],
            'admission_date' => ['nullable', 'date'],
            'roll_number' => ['required', 'string', 'unique:students'],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Student');

            Student::create([
                'user_id' => $user->id,
                'grade_id' => $request->grade_id,
                'section_id' => $request->section_id,
                'guardian_id' => $request->guardian_id,
                'admission_date' => $request->admission_date,
                'roll_number' => $request->roll_number,
            ]);
        });

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load(['user', 'grade', 'section', 'guardian']);
        $grades = Grade::all();
        $sections = Section::all();
        $guardians = Guardian::with('user')->get();
        return view('admin.students.edit', compact('student', 'grades', 'sections', 'guardians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($student->user_id)],
            'grade_id' => ['required', 'exists:grades,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'guardian_id' => ['required', 'exists:guardians,id'],
            'admission_date' => ['nullable', 'date'],
            'roll_number' => ['required', 'string', Rule::unique('students')->ignore($student->id)],
        ]);

        DB::transaction(function () use ($request, $student) {
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $student->update([
                'grade_id' => $request->grade_id,
                'section_id' => $request->section_id,
                'guardian_id' => $request->guardian_id,
                'admission_date' => $request->admission_date,
                'roll_number' => $request->roll_number,
            ]);
        });

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $user = $student->user;
            $student->delete();
            $user->delete();
        });

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
