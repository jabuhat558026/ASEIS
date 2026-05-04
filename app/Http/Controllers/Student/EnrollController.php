<?php
// app/Http/Controllers/Student/EnrollController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
    // Show available courses to enroll
    public function index()
{
    $user = Auth::user();

    // Only exclude ACTIVE enrollments — dropped courses can be re-enrolled
    $enrolledCourseIds = Enrollment::where('user_id', $user->id)
    ->where('status', 'active')
    ->pluck('course_id');

    // Get all courses NOT already enrolled in
    $courses = Course::with('subject')
        ->whereNotIn('id', $enrolledCourseIds)
        ->withCount(['enrollments as enrolled_count' => function ($q) {
            $q->where('status', 'active');
        }])
        ->get();

    // Manually add slots_available since accessor may not work on withCount
    $courses = $courses->map(function ($course) {
        $course->slots = $course->max_students - $course->enrolled_count;
        return $course;
    });

    return view('student.enroll', compact('courses'));
}

    // Store new enrollment
    public function store(Request $request)
{
    $request->validate(['course_id' => 'required|exists:courses,id']);

    $course = Course::findOrFail($request->course_id);
    $user   = Auth::user();

    // Check if already ACTIVELY enrolled
    if ($user->enrollments()->where('course_id', $course->id)->where('status', 'active')->exists()) {
        return back()->with('error', 'You are already enrolled in this course.');
    }

    // Check capacity
    if ($course->enrolled_count >= $course->max_students) {
        return back()->with('error', 'This course is full.');
    }

    // If a dropped record exists, UPDATE it back to active instead of inserting new
    $existing = $user->enrollments()->where('course_id', $course->id)->first();

    if ($existing) {
        // Re-enroll: update the dropped record
        $existing->update([
            'status'          => 'active',
            'enrollment_date' => now()->toDateString(),
        ]);
    } else {
        // Fresh enrollment
        Enrollment::create([
            'user_id'         => $user->id,
            'course_id'       => $course->id,
            'status'          => 'active',
            'enrollment_date' => now()->toDateString(),
        ]);
    }

    return back()->with('success', 'Successfully enrolled in ' . $course->name . '!');
}

    // My subjects
    public function mySubjects()
    {
        $user = Auth::user()->load(['enrollments.course.subject']);
        $active    = $user->enrollments->where('status', 'active');
        $completed = $user->enrollments->where('status', 'completed');
        $dropped   = $user->enrollments->where('status', 'dropped');
        $totalCredits = $active->sum(fn($e) => $e->course->credits ?? 0);

        return view('student.my-subjects', compact('user', 'active', 'completed', 'dropped', 'totalCredits'));
    }

    // Drop course page
    public function dropIndex()
    {
        $user = Auth::user();
        $enrollments = $user->enrollments()->where('status', 'active')->with('course')->get();
        return view('student.drop', compact('enrollments'));
    }

    // Drop a course
    public function drop(Enrollment $enrollment)
    {
        abort_if($enrollment->user_id !== Auth::id(), 403);
        $enrollment->update(['status' => 'dropped']);
        return back()->with('success', 'Course dropped successfully.');
    }
}