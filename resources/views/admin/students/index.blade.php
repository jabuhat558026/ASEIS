@extends('layouts.admin')
@section('title', 'Students')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Students</h1>
        <p class="text-gray-500 text-sm mt-1">Manage student records and information</p>
    </div>
    <a href="{{ route('admin.students.create') }}"
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition">
        <span class="text-lg leading-none">+</span> Add Student
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <p class="font-semibold text-gray-900">All Students ({{ $students->count() }})</p>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Student ID</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Name</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Major</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Enrolled Courses</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Enrollment Date</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($students as $student)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-600">{{ $student->student_id }}</td>
                <td class="px-5 py-4 font-semibold text-gray-900">{{ $student->name }}</td>
                <td class="px-5 py-4 text-blue-600">{{ $student->email }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $student->major ?? '—' }}</td>
                <td class="px-5 py-4">
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">
                        {{ $student->enrolled_courses }} courses
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-600">{{ $student->enrollment_date ?? '—' }}</td>
                <td class="px-5 py-4 flex items-center gap-2">
                    <a href="{{ route('admin.students.edit', $student) }}"
                       class="text-gray-400 hover:text-blue-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('admin.students.destroy', $student) }}"
                          onsubmit="return confirm('Delete this student?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">No students found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection