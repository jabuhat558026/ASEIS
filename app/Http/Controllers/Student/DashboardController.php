<?php
// app/Http/Controllers/Student/DashboardController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->load(['enrollments.course']);
        $active    = $student->enrollments->where('status', 'active');
        $completed = $student->enrollments->where('status', 'completed');
        $totalCredits = $active->sum(fn($e) => $e->course->credits ?? 0);

        return view('student.dashboard', compact('student', 'active', 'completed', 'totalCredits'));
    }
}