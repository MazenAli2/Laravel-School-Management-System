<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Section;

class TeacherDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        // Assuming the user has a 'teacher' relationship or we can query the Teacher model
        $teacher = Teacher::where('user_id', $user->id)->first();

        return view('teacher.dashboard', compact('user', 'teacher'));
    }

    public function myStudents()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        // Get sections where this teacher is assigned
        $sections = Section::where('teacher_id', $teacher->id)->with(['students.user', 'grade'])->get();

        return view('teacher.my-students', compact('sections'));
    }

    public function mySubjects()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();
        $subjects = $teacher->subjects;
        
        // Fetch grade names for the pivot entries to avoid N+1 in view
        $grades = \App\Models\Grade::whereIn('id', $subjects->pluck('pivot.grade_id'))->pluck('name', 'id');

        return view('teacher.my-subjects', compact('subjects', 'grades'));
    }

    public function recordAttendanceForm()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        // Get sections where this teacher is assigned
        // We need to fetch all students from these sections
        $sections = Section::where('teacher_id', $teacher->id)->with(['students.user', 'grade'])->get();

        return view('teacher.record-attendance', compact('sections'));
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|in:Present,Absent,Late',
        ]);

        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        foreach ($request->attendance as $studentId => $data) {
            $attendance = \App\Models\Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'teacher_id' => $teacher->id,
                    'status' => $data['status'],
                    'notes' => $data['notes'] ?? null,
                ]
            );

            // Send notification to parent if student is marked Absent
            if ($data['status'] === 'Absent') {
                $student = \App\Models\Student::with(['guardian.user'])->find($studentId);
                
                if ($student && $student->guardian && $student->guardian->user) {
                    $student->guardian->user->notify(
                        new \App\Notifications\AttendanceAbsentNotification($student, $request->attendance_date)
                    );
                }
            }
        }

        return redirect()->route('teacher.attendance.record')->with('success', 'Attendance recorded successfully.');
    }

    public function viewAttendance(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        // Get sections where this teacher is assigned
        $sections = Section::where('teacher_id', $teacher->id)->with(['students.user', 'grade'])->get();
        
        // Get all student IDs from these sections
        $studentIds = $sections->flatMap(function($section) {
            return $section->students->pluck('id');
        });

        // Fetch attendance records
        $query = \App\Models\Attendance::whereIn('student_id', $studentIds)
                                       ->with(['student.user', 'student.section.grade']);

        // Filter by date if provided
        if ($request->has('date') && $request->date) {
            $query->whereDate('attendance_date', $request->date);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->get();

        return view('teacher.view-attendance', compact('attendances', 'sections'));
    }

    public function recordGradeForm(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        // Get teacher's assigned subjects with grades
        $subjects = $teacher->subjects()->with('teachers')->get();

        $students = collect();
        $selectedSubject = null;
        $selectedGrade = null;

        // If a subject is selected, get students for that subject's grade
        if ($request->has('subject_id') && $request->subject_id) {
            $selectedSubject = \App\Models\Subject::findOrFail($request->subject_id);
            
            // Get the grade_id from the pivot table for this teacher-subject combination
            $teacherSubject = $teacher->subjects()->where('subject_id', $selectedSubject->id)->first();
            
            if ($teacherSubject) {
                $gradeId = $teacherSubject->pivot->grade_id;
                $selectedGrade = \App\Models\Grade::find($gradeId);
                
                // Get all students in this grade
                $students = \App\Models\Student::whereHas('section', function($q) use ($gradeId) {
                    $q->where('grade_id', $gradeId);
                })->with(['user', 'section'])->get();
            }
        }

        return view('teacher.record-grades', compact('subjects', 'students', 'selectedSubject', 'selectedGrade'));
    }

    public function storeGrades(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'grading_date' => 'required|date',
            'term' => 'required|string',
            'grades' => 'required|array',
            'grades.*.student_id' => 'required|exists:students,id',
            'grades.*.score' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        foreach ($request->grades as $grade) {
            if (isset($grade['score']) && $grade['score'] !== null && $grade['score'] !== '') {
                \App\Models\GradeRecord::create([
                    'student_id' => $grade['student_id'],
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $teacher->id,
                    'score' => $grade['score'],
                    'term' => $request->term,
                    'grading_date' => $request->grading_date,
                ]);
            }
        }

        return redirect()->route('teacher.grades.record', ['subject_id' => $request->subject_id])
                         ->with('success', 'Grades recorded successfully.');
    }

    public function myTimetable()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        $slots = \App\Models\TimetableSlot::where('teacher_id', $teacher->id)
                                          ->with(['section.grade', 'subject'])
                                          ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
                                          ->orderBy('start_time')
                                          ->get();

        // Group by day
        $timetable = $slots->groupBy('day_of_week');
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('teacher.my-timetable', compact('timetable', 'days'));
    }
}

