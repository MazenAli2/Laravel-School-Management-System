<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guardian;
use App\Models\Student;

class ParentDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $guardian = Guardian::where('user_id', $user->id)->firstOrFail();
        $students = Student::where('guardian_id', $guardian->id)->with(['user', 'grade', 'section'])->get();

        return view('parent.dashboard', compact('user', 'guardian', 'students'));
    }

    public function viewChildGrades(Request $request)
    {
        $user = Auth::user();
        $guardian = \App\Models\Guardian::where('user_id', $user->id)->firstOrFail();
        $students = \App\Models\Student::where('guardian_id', $guardian->id)->with('user')->get();

        $grades = collect();
        $selectedStudent = null;

        // If a student is selected, get their grades
        if ($request->has('student_id') && $request->student_id) {
            $selectedStudent = \App\Models\Student::where('id', $request->student_id)
                                                  ->where('guardian_id', $guardian->id)
                                                  ->with('user')
                                                  ->firstOrFail();
            
            $grades = \App\Models\GradeRecord::where('student_id', $selectedStudent->id)
                                             ->with(['subject', 'teacher.user'])
                                             ->orderBy('grading_date', 'desc')
                                             ->get();
        }

        return view('parent.child-grades', compact('students', 'grades', 'selectedStudent'));
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('parent.dashboard');
    }
}
