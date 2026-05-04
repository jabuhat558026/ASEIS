<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN 
        User::create([
            'name'  => 'Admin User',
            'email' => 'admin@seis.edu',
            'password' => Hash::make('password'),
            'role'  => 'admin',
        ]);

        User::create([
            'name'  => 'Student User',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'role'  => 'admin',
        ]);

        // SUBJECTS
        $cs = Subject::create([
            'code' => 'CS', 'name' => 'Computer Science',
            'description' => 'Study of computation, algorithms, and information processing',
            'department' => 'Engineering', 'credits' => 3,
        ]);
        $phys = Subject::create([
            'code' => 'PHYS', 'name' => 'Physics',
            'description' => 'Study of matter, energy, and the fundamental forces of nature',
            'department' => 'Natural Sciences', 'credits' => 3,
        ]);
        $math = Subject::create([
            'code' => 'MATH', 'name' => 'Mathematics',
            'description' => 'Study of numbers, quantities, shapes, and patterns',
            'department' => 'Natural Sciences', 'credits' => 4,
        ]);

        // COURSES 
        $cs101 = Course::create([
            'code' => 'CS101', 'name' => 'Introduction to Programming',
            'instructor' => 'Dr. Sarah Wilson', 'schedule' => 'Mon/Wed 10:00-11:30',
            'credits' => 3, 'max_students' => 30, 'subject_id' => $cs->id,
        ]);
        $phys101 = Course::create([
            'code' => 'PHYS101', 'name' => 'General Physics',
            'instructor' => 'Dr. Emily Chen', 'schedule' => 'Mon/Wed/Fri 09:00-10:00',
            'credits' => 3, 'max_students' => 30, 'subject_id' => $phys->id,
        ]);
        $cs202 = Course::create([
            'code' => 'CS202', 'name' => 'Data Structures',
            'instructor' => 'Dr. Sarah Wilson', 'schedule' => 'Tue/Thu 10:00-11:30',
            'credits' => 3, 'max_students' => 30, 'subject_id' => $cs->id,
        ]);
        $math201 = Course::create([
            'code' => 'MATH201', 'name' => 'Calculus II',
            'instructor' => 'Prof. David Brown', 'schedule' => 'Tue/Thu 14:00-15:30',
            'credits' => 4, 'max_students' => 30, 'subject_id' => $math->id,
        ]);

        // STUDENTS
        $michael = User::create([
            'name' => 'Michael Johnson', 'email' => 'michael@seis.edu',
            'password' => Hash::make('password'), 'role' => 'student',
            'student_id' => 'STU001', 'major' => 'Computer Science',
            'enrollment_date' => '2024-09-01',
        ]);
        $jane = User::create([
            'name' => 'Jane Smith', 'email' => 'jane@seis.edu',
            'password' => Hash::make('password'), 'role' => 'student',
            'student_id' => 'STU002', 'major' => 'Physics',
            'enrollment_date' => '2024-09-01',
        ]);

        // ENROLLMENTS 
        Enrollment::create(['user_id' => $michael->id, 'course_id' => $cs101->id,   'status' => 'active', 'enrollment_date' => '2024-09-05']);
        Enrollment::create(['user_id' => $michael->id, 'course_id' => $cs202->id,   'status' => 'active', 'enrollment_date' => '2026-04-05']);
        Enrollment::create(['user_id' => $jane->id,    'course_id' => $phys101->id, 'status' => 'active', 'enrollment_date' => '2024-09-05']);
        Enrollment::create(['user_id' => $jane->id,    'course_id' => $math201->id, 'status' => 'active', 'enrollment_date' => '2026-04-05']);
    }
}