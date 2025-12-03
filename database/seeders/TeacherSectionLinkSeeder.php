<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Student;

class TeacherSectionLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the first teacher
        $teacher = Teacher::first();
        
        if (!$teacher) {
            $this->command->error('No teachers found in the database. Please create a teacher first.');
            return;
        }

        // Find a section that has students
        $section = Section::whereHas('students')->first();
        
        if (!$section) {
            // If no section has students, just get the first section
            $section = Section::first();
            
            if (!$section) {
                $this->command->error('No sections found in the database. Please create a section first.');
                return;
            }
        }

        // Link the teacher to the section
        $section->teacher_id = $teacher->id;
        $section->save();

        $studentCount = $section->students()->count();
        
        $this->command->info("Successfully linked Teacher '{$teacher->user->name}' (ID: {$teacher->id}) to Section '{$section->name}' (ID: {$section->id})");
        $this->command->info("This section has {$studentCount} student(s).");
        $this->command->info("Teacher Email: {$teacher->user->email}");
        $this->command->info("\nYou can now log in as this teacher to see the students in 'My Students' view.");
    }
}
