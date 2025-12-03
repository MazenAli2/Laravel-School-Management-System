<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function report(Request $request)
    {
        $grades = Grade::all();
        $sections = Section::with('grade')->get();

        $query = Attendance::with(['student.user', 'student.section.grade', 'teacher.user']);

        // Filter by grade
        if ($request->has('grade_id') && $request->grade_id) {
            $query->whereHas('student.section', function($q) use ($request) {
                $q->where('grade_id', $request->grade_id);
            });
        }

        // Filter by section
        if ($request->has('section_id') && $request->section_id) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('section_id', $request->section_id);
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('attendance_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('attendance_date', '<=', $request->date_to);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->paginate(50);

        return view('admin.attendance.report', compact('attendances', 'grades', 'sections'));
    }
}
