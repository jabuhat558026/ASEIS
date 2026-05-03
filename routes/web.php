<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollment;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\EnrollController;
use App\Http\Controllers\Student\AccountController;

// AUTH
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ADMIN ROUTES
Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Students
        Route::resource('students', StudentController::class);

        // Courses
        Route::resource('courses', CourseController::class);

        // Subjects
        Route::resource('subjects', SubjectController::class);

        // Enrollments
        Route::get('/enrollments', [AdminEnrollment::class, 'index'])->name('enrollments.index');
        Route::delete('/enrollments/{enrollment}', [AdminEnrollment::class, 'destroy'])->name('enrollments.destroy');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });


// STUDENT ROUTES 
Route::prefix('student')
    ->middleware(['auth', 'isStudent'])
    ->name('student.')
    ->group(function () {

        // Dashboard Controller Route
        Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

        // Enroll
        Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll.index');
        Route::post('/enroll', [EnrollController::class, 'store'])->name('enroll.store');

        // My Subjects
        Route::get('/my-subjects', [EnrollController::class, 'mySubjects'])->name('subjects');

        // Drop Course
        Route::get('/drop', [EnrollController::class, 'dropIndex'])->name('drop.index');
        Route::delete('/drop/{enrollment}', [EnrollController::class, 'drop'])->name('drop.destroy');

        // Account
        Route::get('/account', [AccountController::class, 'index'])->name('account');
        Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    });


Route::middleware(['auth', 'isStudent'])->prefix('student')->group(function () {
    Route::get('/dashboard-test', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});