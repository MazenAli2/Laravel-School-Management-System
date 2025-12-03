<?php

namespace App\Http\Controllers;

use App\Models\TimetableSlot;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = TimetableSlot::with(['section.grade', 'subject', 'teacher.user'])
                                   ->orderBy('day_of_week')
                                   ->orderBy('start_time')
                                   ->get();
        
        return view('admin.timetables.index', compact('timetables'));
    }

    public function create()
    {
        $sections = Section::with('grade')->get();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('admin.timetables.create', compact('sections', 'subjects', 'teachers', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        TimetableSlot::create($request->all());

        return redirect()->route('admin.timetables.index')
                         ->with('success', 'Timetable slot created successfully.');
    }

    public function edit(TimetableSlot $timetable)
    {
        $sections = Section::with('grade')->get();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('admin.timetables.edit', compact('timetable', 'sections', 'subjects', 'teachers', 'days'));
    }

    public function update(Request $request, TimetableSlot $timetable)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $timetable->update($request->all());

        return redirect()->route('admin.timetables.index')
                         ->with('success', 'Timetable slot updated successfully.');
    }

    public function destroy(TimetableSlot $timetable)
    {
        $timetable->delete();

        return redirect()->route('admin.timetables.index')
                         ->with('success', 'Timetable slot deleted successfully.');
    }
}
