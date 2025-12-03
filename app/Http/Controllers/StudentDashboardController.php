<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->with(['grade', 'section', 'guardian.user'])->firstOrFail();

        return view('student.dashboard', compact('user', 'student'));
    }

    public function myGuardian()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->with('guardian.user')->firstOrFail();
        $guardian = $student->guardian;

        return view('student.my-guardian', compact('guardian'));
    }

    public function myGrades()
    {
        return view('student.my-grades');
    }

    public function myTimetable()
    {
        $user = Auth::user();
        $student = \App\Models\Student::where('user_id', $user->id)->firstOrFail();

        $slots = \App\Models\TimetableSlot::where('section_id', $student->section_id)
                                          ->with(['subject', 'teacher.user'])
                                          ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
                                          ->orderBy('start_time')
                                          ->get();

        // Group by day
        $timetable = $slots->groupBy('day_of_week');
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('student.my-timetable', compact('timetable', 'days'));
    }
    
    public function myAttendance()
    {
        $user = Auth::user();
        $student = \App\Models\Student::where('user_id', $user->id)->firstOrFail();
        $attendances = \App\Models\Attendance::where('student_id', $student->id)
                                             ->orderBy('attendance_date', 'desc')
                                             ->get();

        return view('student.my-attendance', compact('attendances'));
    }

    public function viewGrades()
    {
        $user = Auth::user();
        $student = \App\Models\Student::where('user_id', $user->id)->firstOrFail();
        $grades = \App\Models\GradeRecord::where('student_id', $student->id)
                                         ->with(['subject', 'teacher.user'])
                                         ->orderBy('grading_date', 'desc')
                                         ->get();

        return view('student.my-grades', compact('grades'));
    }
}
