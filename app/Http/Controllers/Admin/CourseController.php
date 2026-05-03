<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('subject')->withCount(['enrollments as enrolled_count' => fn($q) => $q->where('status','active')])->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('admin.courses.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|unique:courses,code',
            'name'        => 'required|string',
            'instructor'  => 'required|string',
            'schedule'    => 'required|string',
            'credits'     => 'required|integer|min:1',
            'max_students'=> 'required|integer|min:1',
            'subject_id'  => 'nullable|exists:subjects,id',
        ]);
        Course::create($data);
        return redirect()->route('admin.courses.index')->with('success', 'Course created.');
    }

    public function edit(Course $course)
    {
        $subjects = Subject::all();
        return view('admin.courses.edit', compact('course', 'subjects'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'code'        => 'required|unique:courses,code,'.$course->id,
            'name'        => 'required|string',
            'instructor'  => 'required|string',
            'schedule'    => 'required|string',
            'credits'     => 'required|integer|min:1',
            'max_students'=> 'required|integer|min:1',
            'subject_id'  => 'nullable|exists:subjects,id',
        ]);
        $course->update($data);
        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted.');
    }
}