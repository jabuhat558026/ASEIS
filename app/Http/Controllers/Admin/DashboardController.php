<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $activeEnrollments = Enrollment::where('status', 'active')->count();

        $avgCoursesPerStudent = $totalStudents > 0
            ? round($activeEnrollments / $totalStudents, 1)
            : 0;

        // SAFE: only works if relationships exist
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        // SAFE: requires Course -> enrollments relationship
        $popularCourses = Course::withCount(['enrollments' => function ($q) {
                $q->where('status', 'active');
            }])
            ->orderByDesc('enrollments_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalCourses',
            'activeEnrollments',
            'avgCoursesPerStudent',
            'recentEnrollments',
            'popularCourses'
        ));
    }
}