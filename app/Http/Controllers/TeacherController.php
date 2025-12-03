<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
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
            'phone_number' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Teacher');

            Teacher::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
            ]);
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($teacher->user_id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($request, $teacher) {
            $teacher->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $teacher->update([
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
            ]);
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        DB::transaction(function () use ($teacher) {
            $user = $teacher->user;
            $teacher->delete();
            $user->delete();
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
