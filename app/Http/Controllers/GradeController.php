<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:grades,name',
            'notes' => 'nullable|string',
        ]);

        Grade::create($validated);

        return redirect()->route('admin.grades.index')
            ->with('success', 'Grade created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:grades,name,' . $grade->id,
            'notes' => 'nullable|string',
        ]);

        $grade->update($validated);

        return redirect()->route('admin.grades.index')
            ->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('admin.grades.index')
            ->with('success', 'Grade deleted successfully.');
    }
}
