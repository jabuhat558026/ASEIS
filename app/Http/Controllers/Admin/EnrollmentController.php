<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->latest()->get();

        $active    = $enrollments->where('status', 'active')->count();
        $completed = $enrollments->where('status', 'completed')->count();
        $dropped   = $enrollments->where('status', 'dropped')->count();

        return view('admin.enrollments.index', compact('enrollments', 'active', 'completed', 'dropped'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment removed.');
    }
}