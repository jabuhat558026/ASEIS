<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class ReportController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course.subject'])->get();

        $totalEnrollments  = $enrollments->count();
        $activeEnrollments = $enrollments->where('status', 'active')->count();
        $totalCredits      = $enrollments->where('status', 'active')->sum(fn($e) => $e->course->credits ?? 0);

        return view('admin.reports.index', compact(
            'enrollments', 'totalEnrollments', 'activeEnrollments', 'totalCredits'
        ));
    }
}