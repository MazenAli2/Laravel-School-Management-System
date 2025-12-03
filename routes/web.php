<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
    
    Route::get('/assignments/teachers', [\App\Http\Controllers\TeacherSubjectAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments/teachers', [\App\Http\Controllers\TeacherSubjectAssignmentController::class, 'store'])->name('assignments.store');
    
    Route::get('/attendance/report', [\App\Http\Controllers\AdminAttendanceController::class, 'report'])->name('admin.attendance.report');
    
    Route::resource('timetables', \App\Http\Controllers\TimetableController::class)->names('admin.timetables');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:Teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TeacherDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-students', [\App\Http\Controllers\TeacherDashboardController::class, 'myStudents'])->name('my-students');
    Route::get('/my-subjects', [\App\Http\Controllers\TeacherDashboardController::class, 'mySubjects'])->name('my-subjects');
    
    Route::get('/my-timetable', [\App\Http\Controllers\TeacherDashboardController::class, 'myTimetable'])->name('my-timetable');
    
    Route::get('/attendance/record', [\App\Http\Controllers\TeacherDashboardController::class, 'recordAttendanceForm'])->name('attendance.record');
    Route::post('/attendance/store', [\App\Http\Controllers\TeacherDashboardController::class, 'storeAttendance'])->name('attendance.store');
    Route::get('/attendance/view', [\App\Http\Controllers\TeacherDashboardController::class, 'viewAttendance'])->name('attendance.view');
    
    Route::get('/grades/record', [\App\Http\Controllers\TeacherDashboardController::class, 'recordGradeForm'])->name('grades.record');
    Route::post('/grades/store', [\App\Http\Controllers\TeacherDashboardController::class, 'storeGrades'])->name('grades.store');
});

Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\StudentDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-guardian', [\App\Http\Controllers\StudentDashboardController::class, 'myGuardian'])->name('my-guardian');
    Route::get('/my-grades', [\App\Http\Controllers\StudentDashboardController::class, 'viewGrades'])->name('my-grades');
    Route::get('/my-timetable', [\App\Http\Controllers\StudentDashboardController::class, 'myTimetable'])->name('my-timetable');
    Route::get('/my-attendance', [\App\Http\Controllers\StudentDashboardController::class, 'myAttendance'])->name('my-attendance');
});

Route::middleware(['auth', 'role:Parent'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ParentDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/child-grades', [\App\Http\Controllers\ParentDashboardController::class, 'viewChildGrades'])->name('child-grades');
    Route::post('/notifications/{notification}/mark-read', [\App\Http\Controllers\ParentDashboardController::class, 'markNotificationAsRead'])->name('notifications.mark-read');
});
