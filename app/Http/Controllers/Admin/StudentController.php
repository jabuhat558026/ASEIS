<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role' => 'student'
        ]);

        return redirect()->route('admin.students.index');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.students.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.students.index');
    }
}