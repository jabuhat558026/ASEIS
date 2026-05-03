<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('courses')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|unique:subjects,code',
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'department'  => 'nullable|string',
            'credits'     => 'required|integer|min:1',
        ]);
        Subject::create($data);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject created.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'code'        => 'required|unique:subjects,code,'.$subject->id,
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'department'  => 'nullable|string',
            'credits'     => 'required|integer|min:1',
        ]);
        $subject->update($data);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted.');
    }
}