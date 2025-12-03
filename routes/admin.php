<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('grades', GradeController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('teachers', \App\Http\Controllers\TeacherController::class);
    Route::resource('guardians', \App\Http\Controllers\GuardianController::class);
    Route::resource('students', \App\Http\Controllers\StudentController::class);
});
